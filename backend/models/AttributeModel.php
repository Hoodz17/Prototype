<?php

class AttributeModel
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
    public function getAllAttributes()
    {
        $this->db->query(' 
                               SELECT attributeId, attributeName,attributeMainId,m.mainName ,attributeValue,attributeCreateDate, attributeIsActive 
                               FROM attributes as a
                               INNER JOIN mains as m
                               ON a.attributeMainId = m.mainId  WHERE attributeIsActive = 1 
                               ');
        return $this->db->resultSet();
    }


    public function getAttribute($attributeId)
    {
        $this->db->query(' SELECT attributeId, attributeName, attributeCreateDate, attributeValue, attributeIsActive 
                               FROM attributes WHERE attributeId = :attributeId ');
        $this->db->bind("attributeId", $attributeId, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function createAttribute($post, $attributeId){
    $this->db->query('INSERT INTO attributes(attributeId,attributeMainId, attributeName, attributeCreateDate, attributeValue, attributeIsActive) 
                          VALUES (:attributeId,:attributeMainId, :attributeName, :attributeCreateDate, :attributeValue, :attributeIsActive);');
        $this->db->bind(':attributeId', $attributeId);
        $this->db->bind(':attributeMainId', $post['attributeMainId']);
        $this->db->bind(':attributeName', $post['attributeName']);
        $this->db->bind(':attributeValue', $post['attributeValue']);
        $this->db->bind(':attributeCreateDate', time());
        $this->db->bind(':attributeIsActive', 1);
        return $this->db->execute();
    }
    public function deleteAttribute($attributeId){
        $this->db->query('UPDATE attributes SET attributeIsActive = 0 WHERE attributeId = :attributeId');
        $this->db->bind(":attributeId", $attributeId);
        return $this->db->execute();
    }
    public function updateAttribute($post){
        $this->db->query('UPDATE attributes 
                              SET attributeName = :attributeName,
                                  attributeValue = :attributeValue
                                  WHERE attributeId = :attributeId');
        $this->db->bind(':attributeId', $post['attributeId']);
        $this->db->bind(':attributeName', $post['attributeName']);
        $this->db->bind(':attributeValue', $post['attributeValue']);
        return $this->db->execute();
    }
}