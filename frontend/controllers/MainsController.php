<?php
 include APPROOT. '/models/MainModel.php';
class MainsController extends Controller
{
    public $mainModel;
    public $queryBuilder;
    public function __construct()
    {
        $this->mainModel = $this->model('MainModel');
        $this->queryBuilder = new MysqlQueryBuilder;
    }
    public function  read(){
        $params = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $screen = $this->mainModel->getScreens($params['id']);
            $singleScreen = $this->mainModel->getSingleScreen($params['id'], 1);
            $screen = $this->mainModel->getScreens($params['id']);
            array_shift($screen);

        $result = $this->mainModel->getSingleMain($params['id']);
        $data = [
            'title' => 'Books Overview',
            'result' => $result,
            'screen' => $screen,
            'singleScreen' => $singleScreen
        ];
    $this->view('Mains/read', $data);
    }
}