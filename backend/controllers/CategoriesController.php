<?php
class CategoriesController extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = $this->model("CategoryModel");
    }
    public function index(){
        $results = $this->categoryModel->getAllCategories();
        $data = [
                'results' => $results,
                'title' => 'My CategoriesList'
            ];
        $this->view('Categories/index', $data);
    }
    public function create(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryId = $this->generateRandomString(4);
            $post = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $this->categoryModel->createCategory($post, $categoryId);
            header('Location: ' . APPROOT . 'CategoriesController/index');
        } else {
            $this->view('Categories/create');
        }
    }
    public function update($categoryId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->categoryModel->updateCategory($post);
            echo "Succesfully update row";
            header("Location: " . APPROOT . "CategoriesController/index");
        } else {
            $result = $this->categoryModel->getCategory($categoryId);
            $data = [
                'result' => $result
            ];
            $this->view('Categories/update', $data);
        }
    }
    public function delete($categoryId){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->categoryModel->deleteCategory($categoryId);
            echo "Succesfully deleted row";
            header("Location: " . APPROOT . "CategoriesController/");
        } else {
            $data = [
                'title' => 'Delete Category',
                'categoryId' => $categoryId
            ];
            $this->view("Categories/delete", $data);
        }
    }
}