<?php

class MainsController extends Controller
{
    private $mainModel;
    private $collectionModel;
    public function __construct()
    {
        parent::__construct();
        $this->mainModel = $this->model("MainModel");
        $this->collectionModel = $this->model("CollectionModel");

    }
    public function index(){
        $results = $this->mainModel->getAllMains();
        $data = [
            'results' => $results,
            'title' => 'My MainsList'
        ];
        $this->view('Mains/index', $data);
    }
    public function create(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mainId = $this->generateRandomString(4);
            $post = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $this->mainModel->createMain($post, $mainId);
            header('Location: ' . APPROOT . 'MainsController/index');
        } else {
            $results = $this->collectionModel->getAllCollections();
            $data = [
                'results' => $results,
                'title' => 'My MainsList'
            ];
            $this->view('Mains/create', $data);
        }
    }
    public function update($mainId = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->mainModel->updateMain($post);
            echo "Succesfully update row";
            header("Location: " . APPROOT . "MainsController/index");
        } else {
            $results = $this->mainModel->getMain($mainId);

            $collection = $this->collectionModel->getCollection($results->mainCollectionId);
            // Haal mainCollectionID uit results
            // Roep getColletion aan met de collection Id die je hierboven hebt gepakt
            // Dan krijg je de gegevens van de collecrtion: collectionId en collectionName
            // Die moet je dan meegeven aan de updatre.php
            $collections = $this->collectionModel->getAllCollections();
            $data = [
                'results' => $results,
                'collection' => $collection,
                'collections' => $collections
            ];
            $this->view('Mains/update', $data);
        }
    }
    public function delete($mainId){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->mainModel->deleteMain($mainId);
            echo "Succesfully deleted row";
            header("Location: " . APPROOT . "MainsController/");
        } else {
            $data = [
                'title' => ' Delete Mains',
                'mainId' => $mainId
            ];
            $this->view("Mains/delete", $data);
        }
    }

}