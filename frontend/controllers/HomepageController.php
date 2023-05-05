<?php
class HomepageController extends Controller
{
    public $model;
    public $queryBuilder;
    public function __construct()
    {
        $this->model = new Model;
        $this->queryBuilder = new MysqlQueryBuilder;
    }
    public function index()
    {
        $params = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = [
            'select' => 'm.mainId, cat.categoryId, m.mainCollectionId, c.collectionName, s.screenPath, m.mainName, m.mainIsActive, m.mainCreateDate',
            'db' => 'mainhascat AS mc',
            'innerJoin' => array(
                'mains AS m ON mc.mainId = m.mainId', 
                'collections AS c ON m.mainCollectionId = c.collectionId', 
                'screens AS s ON s.screenMainId = m.mainId',
                'categories AS cat ON mc.categoryId = cat.categoryId'
            ),
            'where' => 'm.mainIsActive = 1',
            'and' => 's.screenIsActive = 1',
            'like' => 'm.mainName',
            'groupBy' => 'm.mainId',
            'date' => 'm.mainCreateDate',
            'search' => 'm.mainName',
            'radio' => 'm.mainIsSpotlight',
            'category' => 'cat.categoryId',
            'collection' => 'm.mainCollectionId'
        ];

        $pagination = $this->pagination($params, 12, "Home", $query);
        // creates cards for the index view
        $cards = $this->createCards($pagination['resultsPage'], "4");
        // sends data to index view of mainhascat inner join mains and categories
        $mainsHasCats = $this->model->select(array(
            'select' => 'cat.categoryId, cat.categoryName, m.mainId, m.mainName',
            'db' => 'mainhascat as mc',
            'innerJoin' => array(
                'categories as cat ON cat.categoryId = mc.categoryId', 
                'mains as m ON m.mainId = mc.mainId'
            ),
            'where' => 'm.mainIsActive = 1',
            'groupBy' => 'cat.categoryId'
        ));
        // sends data to index view of collections inner join mains and collections
        $collections = $this->model->select(array(
            'select' => 'cat.categoryId, cat.categoryName, m.mainId, m.mainName, c.collectionId, c.collectionName',
            'db' => 'mainhascat as mc',
            'innerJoin' => array(
                'categories as cat ON cat.categoryId = mc.categoryId', 
                'mains as m ON m.mainId = mc.mainId',
                'collections as c ON c.collectionId = m.mainCollectionId'
            ),
            'where' => 'm.mainIsActive = 1',
            'groupBy' => 'c.collectionId'
        ));
        // sends data to index
        $data = [
            'title' => 'Home Overview',
            'params' => $params,
            'cards' => $cards,
            'mainsHasCats' => $mainsHasCats,
            'collections' => $collections,
            'recordsPerpage' => $pagination['recordsPerpage'],
            'totalRecords' => $pagination['totalRecords'],
            'pageNumber' => $pagination['pageNumber'],
            'nextPage' => $pagination['nextPage'],
            'prevPage' => $pagination['prevPage'],
            'lastPage' => $pagination['lastPage'],
            'lastPagePagination' => $pagination['lastPagePagination'],
            'paginationNumber' => $pagination['paginationNumber'],
            'filterDateFrom' => $pagination['filterDateFrom'],
            'filterDateUntil' => $pagination['filterDateUntil'],
            'urlGet' => $pagination['urlQuery']
        ];

        $this->view('Homepage/index', $data);
    }
}
