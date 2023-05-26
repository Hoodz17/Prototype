 <?php
class Controller
{
    public string $controllerName;
    /**
     * Path towards the controller (without actions appended)
     */
    public string $controllerUrlPath;

    public function __construct() {
        $this->controllerName = str_replace("Controller", "", get_class($this));
        $this->controllerUrlPath = APPROOT . $this->controllerName . 'Controller/';
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
        require(APPROOT . '/views/Includes/header.php');
        if (file_exists(APPROOT . '/views/' . $view . '.php')) {
            require_once(APPROOT . '/views/' . $view . '.php');
        } else {
            echo 'View does not exist.';
        }
        require(APPROOT . '/views/Includes/footer.php');
    }

    public function error($errorMessage, $data = array()) {
        http_response_code(400);
        $data['errorMessage'] = $errorMessage;
        $this->view('_base/error', $data);
    }

    public function notFound() {
        http_response_code(404);
        $this->view('_base/notfound');
    }

    public function ChangeQuery($array_of_queries_to_change)
    {
        $array_of_queries_to_change_count = count($array_of_queries_to_change); // count how much db we have in total. count the inactives too. 
        $new_get = $_GET;
        $i0 = 0;

        while ($i0 < $array_of_queries_to_change_count) {
            $array_of_keys_of_array_of_queries_to_change = array_keys($array_of_queries_to_change);
            $new_get[$array_of_keys_of_array_of_queries_to_change[$i0]] = $array_of_queries_to_change[$array_of_keys_of_array_of_queries_to_change[$i0]];
            $i0++;
        }

        $query = "?" . http_build_query($new_get);
        return $query;
    }

    public function buildPageTitle(array $data) {
        if (!array_key_exists("title", $data)) {
            return "";
        }

        $title = $data["title"];
        return "$title - ";
    }
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function imguploader(){
        //img uploader
        $screenId = $this->generateRandomString(4);
        $type = explode("/", $_FILES['fileToUpload']["type"]);
        $fileType = $type[1];
        $target_dir = PROJECTROOT . "/public/uploads/";
        $target_file = $target_dir . $screenId . "." . $fileType;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( $screenId. " has been uploaded.");
                var_dump($target_file); exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function imageUploader(){
 $screenId = RandomGenerator::generateRandomString(4);
 // Create folder with name YYYYMM
 if (!file_exists(PROJECTROOT . "/public/uploads/" . date("Ym"))) {
     mkdir(PROJECTROOT . "/public/uploads/" . date("Ym"), 0777, true);
 }
 $mime_type = mime_content_type($_FILES['fileToUpload']['tmp_name']);
 $allowed_file_types = ['image/png', 'image/jpeg', 'image/bmp', 'image/gif', 'image/webp'];
 $target_dir = PROJECTROOT . "/public/uploads/" . date("Ym") . "/";
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
 $imgPath = "public/uploads/" . date("Ym") . "/" . $screenId . ".jpg";
 // $this->convertImage($imgPath, $imgPath, 100);
 return $imgPath;

}
}