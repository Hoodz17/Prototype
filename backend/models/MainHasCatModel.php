<?php

class MainHasCatModel
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
    public function getAllMainsHasCats()
    {
        $this->db->query(' SELECT m.mainId, c.categoryId, m.mainName, c.categoryName
                               FROM mainhascat as mc
                               INNER JOIN mains as m
                               on m.mainId = mc.mainId
                               INNER JOIN categories as c
                               on c.categoryId = mc.categoryId
                               ');
        return $this->db->resultSet();
    }
    public function getMainHasCat($mainId,$categoryId)
    {
        $this->db->query(' SELECT m.mainId, c.categoryId, m.mainName, c.categoryName
                               FROM mainhascat as mc
                               INNER JOIN mains as m
                               on m.mainId = mc.mainId
                               INNER JOIN categories as c
                               on c.categoryId = mc.categoryId 
                               WHERE m.mainId = :mainId && c.categoryId = :categoryId');
        $this->db->bind("mainId", $mainId, PDO::PARAM_INT);
        $this->db->bind("categoryId", $categoryId, PDO::PARAM_INT);
        return $this->db->single();
    }
    public function createMainHasCat($post){
        $this->db->query('INSERT INTO  mainhascat (mainId, categoryId) 
                          VALUES (:mainId,  :categoryId );');
        $this->db->bind('mainId', $post['mainId']);
        $this->db->bind('categoryId', $post['categoryId']);
        return $this->db->execute();
    }
    public function updateMainHasCat($post){
        $this->db->query('UPDATE mainhascat
                              SET mainId = :mainId,
                                  categoryId = :categoryId
                                  WHERE mainId = :mainHasCatMainId AND categoryId = :mainHasCatCategoryId');
        $this->db->bind(':mainId', $post['mainId']);
        $this->db->bind(':mainHasCatMainId', $post['mainHasCatMainId']);
        $this->db->bind(':categoryId', $post['categoryId']);
        $this->db->bind(':mainHasCatCategoryId', $post['mainHasCatCategoryId']);
        return $this->db->execute();
    }

    public function deleteMain($post){
        $this->db->query('DELETE FROM mainhascat WHERE mainId = :mainId AND categoryId = :categoryId');
        $this->db->bind(':mainId', $post['mainId']);
        $this->db->bind(':categoryId', $post['categoryId']);
        return $this->db->execute();
    }
}