<?php

class categoryModel
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

    public function getAllCategories()
    {
        $this->db->query(' SELECT categoryId, categoryName, categoryCreateDate, categoryIsActive 
                               FROM Categories WHERE categoryIsActive = 1 ');
        return $this->db->resultSet();
    }

    public function getCategory($categoryId)
    {
        $this->db->query(' SELECT categoryId, categoryName, categoryCreateDate, categoryIsActive 
                               FROM Categories WHERE categoryId = :categoryId ');
        $this->db->bind(":categoryId", $categoryId, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function createCategory($post, $categoryId){
    $this->db->query('INSERT INTO `Categories`(`categoryId`, `categoryName`, `categoryCreateDate`, `categoryIsActive`) 
                          VALUES (:categoryId, :categoryName, :categoryCreateDate, :categoryIsActive);');
        $this->db->bind(':categoryId', $categoryId);
        $this->db->bind(':categoryName', $post['categoryName']);
        $this->db->bind(':categoryCreateDate', time());
        $this->db->bind(':categoryIsActive', 1);
        return $this->db->execute();
    }
    public function deleteCategory($categoryId){
        $this->db->query('UPDATE Categories SET categoryIsActive = 0 WHERE categoryId = :categoryId');
        $this->db->bind(":categoryId", $categoryId, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function updateCategory($post){
        $this->db->query('UPDATE Categories 
                              SET categoryName = :categoryName
                                  WHERE categoryId = :categoryId');
        $this->db->bind(':categoryId', $post['categoryId']);
        $this->db->bind(':categoryName', $post['categoryName']);
        return $this->db->execute();
    }
}
