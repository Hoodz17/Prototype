<?php
class CollectionsController extends Controller
{
    private $collectionModel;

    public function __construct()
    {
        parent::__construct();
        $this->collectionModel = $this->model("CollectionModel");
    }
    public function index(){
        $params = filter_input_array(INPUT_GET, FILTER_UNSAFE_RAW);
        $recordsPerPage = 4;

        if(!isset($params['page'])){
            header("Location: " . BACKENDROOT . "CollectionsController/index/?page=" . $recordsPerPage);
        } else{

        }
        $pageNumber = $params['page'];
        $offset =  $pageNumber - $recordsPerPage;
        $paginationNumber = $pageNumber / $recordsPerPage;
        $nextPage = $pageNumber + $recordsPerPage;
        $prevPage = $pageNumber - $recordsPerPage;
        $totalRecords = count($this->collectionModel->getAllCollections());
        $lastPage = ceil($totalRecords/$recordsPerPage);
        $results = $this->collectionModel->getByPagination($recordsPerPage,$offset);
        $data = [ 
                'nextPage' => $nextPage,
                'prevPage' => $prevPage,
                'result' => $results,
                'title' => 'My CollectionList'
            ];
        $this->view('Collections/index', $data);
    }

    public function create(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $collectionId = $this->generateRandomString(4);
            $post = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $this->collectionModel->createCollection($post, $collectionId);
            header('Location: ' . BACKENDROOT . 'CollectionsController/index');
        } else {
            $this->view('Collections/create');
        }
    }
    public function update($collectionId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->collectionModel->updateCollection($post);

            echo "Succesfully update row";
            header("Location: " . BACKENDROOT . "CollectionsController/index");
        } else {
            $results = $this->collectionModel->getCollection($collectionId);
            $data = [
                'result' => $results
            ];
            $this->view('Collections/update', $data);
        }
    }
    public function delete($collectionId){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->collectionModel->deleteCollection($collectionId);
            echo "Succesfully deleted row";
            header("Location: " . BACKENDROOT . "CollectionsController/index");
        } else {
            $data = [
                'title' => 'Delete Collection',
                'collectionId' => $collectionId
            ];
            $this->view("Collections/delete", $data);
        }
    }
}