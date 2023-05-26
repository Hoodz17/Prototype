<?php
class Controller
{
    public string $controllerName;
    /**
     * Path towards the controller (without actions appended)
     */
    public string $controllerUrlPath;



    public function __construct()
    {
        $this->controllerName = str_replace("Controller", "", get_class($this));
        $this->controllerUrlPath = ROOT . $this->controllerName . 'Controller/';
    }

    public function model($model, Database $db = null)
    {
        require_once(APPROOT . '/models/' . $model . '.php');
        if ($db != null) {
            return new $model($db);
        } else {
            return new $model;
        }
    }

    public function view($view, $data = [])
    {
        if (http_response_code() == 404) {
            if (file_exists(APPROOT . '/views/' . $view . '.php')) {
                require_once(APPROOT . '/views/_base/notfound.php');
            } else {
                echo 'View does not exist.';
            }
        } else {
            require(APPROOT . '/views/Includes/header.php');
            if (file_exists(APPROOT . '/views/' . $view . '.php')) {
                require_once(APPROOT . '/views/' . $view . '.php');
            } else {
                echo 'View does not exist.';
            }
            require(APPROOT . '/views/Includes/footer.php');
        }
    }

    public function error($errorMessage, $data = array())
    {
        http_response_code(400);
        $data['errorMessage'] = $errorMessage;
        $this->view('_base/error', $data);
    }

    public function notFound()
    {
        http_response_code(404);
        $this->view('_base/notfound');
    }

    public function buildPageTitle(array $data)
    {
        if (!array_key_exists("title", $data)) {
            return "";
        }

        $title = $data["title"];
        return "$title - ";
    }
    // pagination function for all controllers
    public function pagination($params, $recordsPerpage, $controllerName, $query)
    {
        $model = new Model();
        $filterDateFrom = 0;
        $filterDateUntil = 0;
        $urlQuery = "";
        $searchIndex = "";
        $radioFilter = "";
        $inArray = [];
        $andArray = (isset($query['and'])) ? [$query['and']] : [];
        $orArray = (isset($query['or'])) ? [$query['or']] : [];
        $bindsArray = [];

        // Check if page from url isset, is empty, is int, or is equal to 0 or less
        if (!isset($params['page']) || empty($params['page']) || !ctype_digit($params['page']) || $params['page'] <= 0) {
            header("Location: " . URLROOT . $controllerName . "Controller/?page=" . $recordsPerpage);
            return;
            // Check if page from url is bigger than the total amount of pages
        } elseif ($params['page'] < $recordsPerpage) {
            $params['page'] = $recordsPerpage;
            header("Location: " . URLROOT . $controllerName . "Controller/?page=" . $params['page']);
            return;
        }

        // Puts the get of page into the variable $pageNumber
        $pageNumber = $params['page'];
        $offsetValue = $pageNumber - $recordsPerpage;
        // Check if the page number is bigger than the total amount of pages
        if (!empty($params['filterDateFrom']) && !empty($params['filterDateUntil'])) {
            $urlQuery = '&filterDateFrom=' . urlencode($params['filterDateFrom']) . '&filterDateUntil=' . urlencode($params['filterDateUntil']);
            $filterDateFrom = DateTime::createFromFormat("d/m/Y H:i", $params['filterDateFrom'] . ' 00:00')->getTimestamp();
            $filterDateUntil = DateTime::createFromFormat("d/m/Y H:i", $params['filterDateUntil'] . ' 23:59')->getTimestamp();
            $andArray[] = $query['date'] . " BETWEEN :filterDateFrom AND :filterDateUntil";
            $bindsArray += ['filterDateFrom' => $filterDateFrom];
            $bindsArray += ['filterDateUntil' => $filterDateUntil];
        }
        // Check if the page number is bigger than the total amount of pages
        if (!empty($params['search-index']) && isset($query['like'])) {
            if (ctype_alnum($query['like'])) {
                $search_index = ":" . $query['like'];
            } else {
                $search_index = ":" . preg_replace("/[^A-Za-z0-9 ]/", '', $query['like']);
            }
            $searchIndex = '%' . $params['search-index'] . '%';
            $andArray[] = $query['like'] . " LIKE " . $search_index;
            $bindsArray += [$search_index => $searchIndex];
        }
        // Check if the page number is bigger than the total amount of pages
        if (isset($params['radio-filter']) && $params['radio-filter'] != 2) {
            if (ctype_alnum($query['radio'])) {
                $radio = ":" . $query['radio'];
            } else {
                $radio = ":" . preg_replace("/[^A-Za-z0-9 ]/", '', $query['radio']);
            }
            $radioFilter = $params['radio-filter'];
            $andArray[] = $query['radio'] . " = " . $radio;
            $bindsArray += [$radio => $radioFilter];
        }
        if (!empty($params['category-checkbox'])) {
            $counter = 0;
            $category = [];
            foreach ($params['category-checkbox'] as $categoryCheckbox) {
                if (ctype_alnum($query['category'])) {
                    $category[] = ":" . $query['category'] . $counter;
                } else {
                    $category[] = ":" . preg_replace("/[^A-Za-z0-9 ]/", '', $query['category']) . $counter;
                }
                $bindsArray += [$category[$counter] => $categoryCheckbox];
                $counter++;
            }
            $category = implode(", ", $category);
            $inArray[] = $query['category'] . " IN(" . $category . ")";
        }
        // Check if the page number is bigger than the total amount of pages
        if (!empty($params['collection-checkbox'])) {
            $counter = 0;
            foreach ($params['collection-checkbox'] as $collectionCheckbox) {
                if (ctype_alnum($query['collection'])) {
                    $collection = ":" . $query['collection'] . $counter;
                } else {
                    $collection = ":" . preg_replace("/[^A-Za-z0-9 ]/", '', $query['collection'])  . $counter;
                }
                $orArray[] = $query['collection'] . " = " . $collection;
                $bindsArray += [$collection => $collectionCheckbox];
                $counter++;
            }
        }
        $resultsQuery = [
            'select' => $query['select'],
            'db' => $query['db'],
            'innerJoin' => (isset($query['innerJoin'])) ? $query['innerJoin'] : NULL,
            'where' => $query['where'],
            'and' => $andArray,
            'in' => $inArray,
            'or' => $orArray,
            'groupBy' => $query['groupBy'],
            'binds' => $bindsArray
        ];

        $results = $model->select($resultsQuery);

        $totalRecords = count($results);
        $lastPage = ceil($totalRecords / 10) * $recordsPerpage;

        if (!empty($results)) {
            if ($pageNumber > $lastPage) {
                $this->notFound();
            } elseif (($pageNumber % $recordsPerpage) != 0) {
                $this->notFound();
            }
        }
        $paginationNumber = $pageNumber / $recordsPerpage;
        $nextPage = $pageNumber + $recordsPerpage;
        $prevPage = $pageNumber - $recordsPerpage;

        $offsetResults = $model->select(array(
            'select' => $query['select'],
            'db' => $query['db'],
            'innerJoin' => (isset($query['innerJoin'])) ? $query['innerJoin'] : NULL,
            'where' => $query['where'],
            'and' => $andArray,
            'in' => $inArray,
            'or' => $orArray,
            'groupBy' => $query['groupBy'],
            'binds' => $bindsArray,
            'limit' => $recordsPerpage,
            'offset' => $offsetValue
        ));


        $resultsPage = [];
        $counter = 0;
        foreach ($offsetResults as $result) {
            if ($counter < $recordsPerpage) {
                $resultsPage[] = $result;
            } else {
                break;
            }
            $counter++;
        }
        $lastPagePagination = $lastPage / $recordsPerpage;

        return $pagination = [
            'pageNumber' => $pageNumber,
            'offsetValue' => $offsetValue,
            'recordsPerpage' => $recordsPerpage,
            'totalRecords' => $totalRecords,
            'lastPage' => $lastPage,
            'paginationNumber' => $paginationNumber,
            'nextPage' => $nextPage,
            'prevPage' => $prevPage,
            'recordsPerpage' => $recordsPerpage,
            'paginationNumber' => $paginationNumber,
            'lastPagePagination' => $lastPagePagination,
            'resultsPage' => $resultsPage,
            'filterDateFrom' => $filterDateFrom,
            'filterDateUntil' => $filterDateUntil,
            'urlQuery' => $urlQuery
        ];
    }
    // Function to get the total amount of pages
    public function imageUploader()
    {
        $screenId = RandomGenerator::generateRandomString(4);

        // Create folder with name YYYYMM
        if (!file_exists(ROOT . "/assets/media/" . date("Ym"))) {
            mkdir(ROOT . "/assets/media/" . date("Ym"), 0777, true);
        }

        $mime_type = mime_content_type($_FILES['fileToUpload']['tmp_name']);
        $allowed_file_types = ['image/png', 'image/jpeg', 'image/bmp', 'image/gif', 'image/webp'];
        $target_dir = ROOT . "/assets/media/" . date("Ym") . "/";
        $fileName = $screenId . ".jpg";
        $target_file = $target_dir . $fileName;

        $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 31457280) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        if (!in_array($mime_type, $allowed_file_types)) {
            $uploadOk = 0;
        }

        // // Allow certain file formats
        // if (
        //     $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        //     && $imageFileType != "gif"
        // ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $imgPath = "assets/media/" . date("Ym") . "/" . $screenId . ".jpg";

        // $this->convertImage($imgPath, $imgPath, 100);

        return $imgPath;
    }

    public function createCards($mains, $col)
    {
        $cards = "";
        foreach ($mains as $main) {
            $cards .= "<div class='stats-card bg-light radius-md padding-md inner-glow shadow-xs col-" . $col . "@sm'>
                                <figure class='card__img-wrapper'>
                                    <img src='" . URLROOT . $main->screenPath . "' style='height:350px;'>
                                </figure>
                
                                <div class='padding-xs'>
                                    <h4>" . $main->mainName . "</h4>
                                    <footer>
                                        <a href='" . URLROOT . "MainsController/read?id=" . $main->mainId . "' class='btn btn--primary text-sm'>Read More</a>
                                    </footer>
                                </div>
                           </div>";
        }
        return $cards;
    }
}
