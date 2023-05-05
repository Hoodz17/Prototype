<?php

class CollectionModel
{
    public $db;

    public function __construct($db = null)
    {
        if (isset($db)) {
            $this->db = $db;
        } else {
            $this->db = new Database;
        }
    }
    public function getAllCollections()
    {
        $this->db->query(' SELECT collectionId, collectionName, collectionCreateDate, collectionIsActive 
                               FROM collections WHERE collectionIsActive = 1');
        return $this->db->resultSet();
    }
    public function getByPagination($limit, $offset)
    {
        $this->db->query(' SELECT collectionId, collectionName, collectionCreateDate, collectionIsActive 
                               FROM collections WHERE collectionIsActive = 1 LIMIT :limit OFFSET :offset');
        $this->db->bind(":limit", $limit);
        $this->db->bind(":offset", $offset);

        return $this->db->resultSet();
    }

    public function getCollection($collectionId)
    {
        $this->db->query(' SELECT collectionId, collectionName, collectionCreateDate, collectionIsActive 
                               FROM collections WHERE collectionId = :collectionId ');
        $this->db->bind("collectionId", $collectionId, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function createCollection($post, $collectionId){
    $this->db->query('INSERT INTO `collections`(`collectionId`, `collectionName`, `collectionCreateDate`, `collectionIsActive`) 
                          VALUES (:collectionId, :collectionName, :collectionCreateDate, :collectionIsActive);');
        $this->db->bind(':collectionId', $collectionId);
        $this->db->bind(':collectionName', $post['collectionName']);
        $this->db->bind(':collectionCreateDate', time());
        $this->db->bind(':collectionIsActive', 1);
        return $this->db->execute();
    }
    public function deleteCollection($collectionId){
        $this->db->query('UPDATE collections SET collectionIsActive = 0 WHERE collectionId = :collectionId');
        $this->db->bind("collectionId", $collectionId, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function updateCollection($post){
        $this->db->query('UPDATE collections 
                              SET collectionName = :collectionName
                                  WHERE collectionId = :collectionId');
        $this->db->bind(':collectionId', $post['collectionId']);
        $this->db->bind(':collectionName', $post['collectionName']);
        return $this->db->execute();
    }
}
