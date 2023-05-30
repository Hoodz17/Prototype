<?php
class MainModel
{
    public $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMains($data = NULL)
    {
        $baseQuery = 'SELECT mainId, mainCollectionId, collections.collectionName, mainName, mainIsActive, mainCreateDate, mainDescription FROM mains
                      INNER JOIN collections
                      ON mains.mainCollectionId = collections.collectionId
                      WHERE mainIsActive = 1';




//        $isActiveQuery = $baseQuery . ' WHERE mainIsActive = 1';


//        if (isset($data)) {
//            if ($data['type'] == 'getById') {
//                $this->db->query("$baseQuery WHERE mainId = :mainId");
//                $this->db->bind(":mainId", $data['mainId']);
//                return $this->db->single();
//            }
//            if ($data['type'] == 'getByDate') {
//                $isActiveQuery .= " AND mainCreateDate BETWEEN :filterDateFrom AND :filterDateUntil";
//            } elseif ($data['type'] == 'getPagination') {
//                $isActiveQuery .= " LIMIT :recordsPerpage OFFSET :offsetValue";
//            } elseif ($data['type'] == 'getPaginationByDate') {
//                $isActiveQuery .= " AND mainCreateDate BETWEEN :filterDateFrom AND :filterDateUntil LIMIT :recordsPerpage OFFSET :offsetValue";
//            }
//
//            $this->db->query("$isActiveQuery");
//
//            if (isset($data['recordsPerpage'])) {
//                $this->db->bind(":recordsPerpage", $data['recordsPerpage']);
//            }
//            if (isset($data['offsetValue'])) {
//                $this->db->bind(":offsetValue", $data['offsetValue']);
//            }
//            if (isset($data['filterDateFrom'])) {
//                $this->db->bind(":filterDateFrom", $data['filterDateFrom']);
//            }
//            if (isset($data['filterDateUntil'])) {
//                $this->db->bind(":filterDateUntil", $data['filterDateUntil']);
//            }
//
//            return $this->db->resultSet();
//        }
    }
    public function  getSingleMain($mainId){
        $this->db->query("SELECT * FROM mainhascat 
                      INNER JOIN mains
                      ON mainhascat.mainId = mains.mainId 
                      INNER JOIN collections
                      ON mains.mainCollectionId = collections.collectionId
                      INNER JOIN categories
                      ON mainhascat.categoryId = categories.categoryId
                      WHERE mainhascat.mainId = :mainId");
        $this->db->bind(":mainId", $mainId);
        return $this->db->single();
    }
    public function getScreens($mainId){
        $this->db->query(" SELECT * FROM screens WHERE screenMainId = :mainId and screenIsActive = 1 ORDER BY screenLocation ASC");
        $this->db->bind(":mainId", $mainId);
        return $this->db->resultSet();
    }

    public function getSingleScreen($mainId, $location = NULL) {
        $screenLocation = (isset($location))?$location:1;
        $this->db->query(" SELECT * FROM screens WHERE screenMainId = :mainId AND screenLocation = :screenLocation");
        $this->db->bind(":mainId", $mainId);
        $this->db->bind(":screenLocation", $screenLocation);
        return $this->db->single();
    }
}
