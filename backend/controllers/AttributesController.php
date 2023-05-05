<?php

class AttributesController extends Controller
{
    public $attributeModel;
    public $mainModel;
    public function __construct()
    {
        parent::__construct();
        $this->attributeModel = $this->model("AttributeModel");
        $this->mainModel = $this->model("MainModel");
    }
    public function index(){
        $results = $this->attributeModel->getAllAttributes();
        $data = [
            'results' => $results,
            'title' => 'My AttributeList'
        ];
        $this->view('Attributes/index', $data);
    }
    public function create(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $attributeId = $this->generateRandomString(4);
            $post = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $this->attributeModel->createAttribute($post, $attributeId);
            header('Location: ' . APPROOT . 'AttributesController/index');
        } else {
            $mains = $this->mainModel->getAllMains();
            $data = [
              'mains' => $mains
            ];
            $this->view('Attributes/create', $data);
        }
    }
    public function update($attributeId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->attributeModel->updateAttribute($post);
            echo "Succesfully update row";
            header("Location: " . APPROOT . "AttributesController/index");
        } else {
            $result = $this->attributeModel->getAttribute($attributeId);
            $mains = $this->mainModel->getAllMains();
            $data = [
                'result' => $result,
                'mains' => $mains
            ];
            $this->view('Attributes/update', $data);
        }
    }
    public function delete($attributeId){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->attributeModel->deleteAttribute($attributeId);
            echo "Succesfully deleted row";
            header("Location: " . APPROOT . "AttributesController/");
        } else {
            $data = [
                'title' => 'Delete Attribute',
                'attributeId' => $attributeId
            ];
            $this->view("Attributes/delete", $data);
        }
    }

}