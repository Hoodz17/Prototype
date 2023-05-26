<?php
class ScreensController extends Controller
{
    private $screenModel;
    public $mainModel;

    public function __construct()
    {
        parent::__construct();
        $this->screenModel = $this->model("ScreenModel");
        $this->mainModel = $this->model("MainModel");
    }
    public function index(){
        $results = $this->screenModel->getAllScreens();
        $data = [
            'result' => $results,
            'title' => 'My ScreenList'
        ];
        $this->view('Screens/index', $data);
    }
    public function create(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $screenId = $this->generateRandomString(4);
            $imgPath = $this->imageUploader();
            $this->screenModel->createScreen($post, $screenId, $imgPath);
            header('Location: ' . BACKENDROOT . 'ScreensController/index');
        } else {
            $mains = $this->mainModel->getAllMains();
            $data = [
                'mains' => $mains
            ];
            $this->view('Screens/create', $data);
        }
    }
    public function update($screenId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $imgPath = $this->imageUploader();
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->screenModel->updateScreen($post,$imgPath);
            echo "Succesfully update row";
            header("Location: " . BACKENDROOT . "ScreensController/index");
        } else {
            $screen = $this->screenModel->getScreen($screenId);
            $main = $this->mainModel->getMain($screen->screenMainId);
            $mains = $this->mainModel->getAllMains();
            $data = [
            'screen' => $screen,
            'main' => $main,
            'mains' => $mains
            ];
            $this->view('Screens/update', $data);
        }
    }
    public function delete($screenId){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->screenModel->deleteScreen($screenId);
            echo "Succesfully deleted row";
            header("Location: " . BACKENDROOT . "ScreensController/index");
        } else {
            $data = [
                'title' => 'Delete Screen',
                'screenId' => $screenId
            ];
            $this->view("Screens/delete", $data);
        }
    }
}