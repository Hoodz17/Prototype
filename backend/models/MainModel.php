<?php
class MainModel
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
    public function getAllMains()
    {
        $this->db->query(' SELECT mainId, mainName,mainCollectionId,collections.collectionName ,mainCreateDate, mainIsActive 
                               FROM mains
                               INNER JOIN collections
                               ON mains.mainCollectionId = collections.collectionId 
                               WHERE mainIsActive = 1 
                               AND collections.collectionIsActive = 1 ');
        return $this->db->resultSet();
    }
    public function getMain($mainId)
    {
        $this->db->query(' SELECT mainId, mainName, mainCollectionId, mainCreateDate, mainIsActive 
                               FROM mains WHERE mainId = :mainId ');
        $this->db->bind("mainId", $mainId, PDO::PARAM_INT);
        return $this->db->single();
    }
    public function createMain($post, $mainId){
        $this->db->query('INSERT INTO  mains ( mainId , mainCollectionId,  mainName , mainCreateDate ,  mainIsActive ) 
                          VALUES (:mainId, :mainCollectionId, :mainName, :mainCreateDate, :mainIsActive);');
        $this->db->bind(':mainId', $mainId);
        $this->db->bind(':mainCollectionId', $post['collectionId']);
        $this->db->bind(':mainName', $post['mainName']);
        $this->db->bind(':mainCreateDate', time());
        $this->db->bind(':mainIsActive', 1);
        return $this->db->execute();
    }
    public function deleteMain($mainId){
        $this->db->query('UPDATE mains SET mainIsActive = 0 WHERE mainId = :mainId');
        $this->db->bind("mainId", $mainId, PDO::PARAM_INT);
        return $this->db->execute();
    }
    public function updateMain($post){
        $this->db->query('UPDATE mains 
                              SET mainName = :mainName,
                                  mainCollectionId = :mainCollectionId
                                  WHERE mainId = :mainId');
        $this->db->bind(':mainId', $post['mainId']);
        $this->db->bind(':mainCollectionId', $post['collectionId']);
        $this->db->bind(':mainName', $post['mainName']);
        return $this->db->execute();
    }
}
