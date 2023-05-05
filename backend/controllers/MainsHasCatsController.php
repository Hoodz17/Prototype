<?php

class MainsHasCatsController extends Controller
{
    private $mainHasCatModel;
    private $mainModel;
    private $categoryModel;
    public function __construct()
    {
        parent::__construct();
        $this->mainHasCatModel = $this->model("MainHasCatModel");
        $this->mainModel = $this->model("MainModel");
        $this->categoryModel = $this->model("CategoryModel");
    }
    public function index(){
        $results = $this->mainHasCatModel->getAllMainsHasCats();
        $data = [
            'result' => $results,
            'title' => 'My MainsHasCatList'
        ];
        $this->view('MainsHasCats/index', $data);
    }
    public function create(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $this->mainHasCatModel->createMainHasCat($post);
            header('Location: ' . APPROOT . 'MainsHasCatsController/index');
        } else {
            $mains = $this->mainModel->getAllMains();
            $categories = $this->categoryModel->getAllCategories();
            $data = [
                'main' => $mains,
                'category' => $categories,
                'title' => 'My MainsHasCatsList'
            ];
            $this->view('MainsHasCats/create', $data);
        }
    }
    public function update($mainCatId)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->mainHasCatModel->updateMainHasCat($post);
            echo "Succesfully update row";
            header("Location: " . APPROOT . "MainsHasCatsController/index");
        } else {
            $mainCatId = explode('+', $mainCatId);
            $mainId = $mainCatId[0];
            $categoryId = $mainCatId[1];
            $result = $this->mainHasCatModel->getMainHasCat($mainId,$categoryId);
            $mains = $this->mainModel->getAllMains();
            $categories = $this->categoryModel->getAllCategories();
            $data = [
                'result' => $result,
                'main' => $mains,
                'category' => $categories
            ];
            $this->view('MainsHasCats/update', $data);
        }
    }
    public function delete($mainCatId){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->mainHasCatModel->deleteMain($post);
            echo "Succesfully deleted row";
            header("Location: " . APPROOT . "MainsHasCatsController/index");
        } else {
            $mainCatId = explode('+', $mainCatId);
            $mainId = $mainCatId[0];
            $categoryId = $mainCatId[1];
            $data = [
                'title' => 'Delete MainsHasCat',
                'mainCatId' => $mainCatId,
                'mainId' => $mainId,
                'categoryId' => $categoryId
            ];
            $this->view("MainsHasCats/delete", $data);
        }
    }
}