<?php
class ScreenModel
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
    public function getAllScreens()
    {
        $this->db->query(' SELECT screenId, screenMainId, screenPath, m.mainName, screenCreateDate,screenLocation, screenIsActive
                               FROM screens as s
                               INNER JOIN mains as m
                               ON s.screenMainId = m.mainId WHERE screenIsActive = 1 ');
        return $this->db->resultSet();
    }

    public function getScreen($screenId)
    {
        $this->db->query(' SELECT screenId, screenMainId, screenPath, m.mainName, screenCreateDate,screenLocation, screenIsActive
                               FROM screens as s 
                               INNER JOIN mains as m
                                ON s.screenMainId = m.mainId
                               WHERE screenId = :screenId ');
        $this->db->bind("screenId", $screenId, PDO::PARAM_INT);
        return $this->db->single();
    }
    public function createScreen($post, $screenId, $imgPath){
        $this->db->query('INSERT INTO screens(screenId,screenMainId, screenPath, screenCreateDate,screenLocation, screenIsActive)
                          VALUES (:screenId,:screenMainId,:screenPath, :screenCreateDate,:screenLocation, :screenIsActive);');
        $this->db->bind(':screenId', $screenId);
        $this->db->bind(':screenMainId', $post['mainId']);
        $this->db->bind(':screenPath', $imgPath);
        $this->db->bind(':screenLocation', $post['screenLocation']);
        $this->db->bind(':screenCreateDate', time());
        $this->db->bind(':screenIsActive', 1);
        return $this->db->execute();
    }
    public function updateScreen($post, $imgPath){
        $this->db->query('UPDATE screens
                              SET screenPath = :screenPath,
                                  screenMainId = :screenMainId,
                                  screenLocation = :screenLocation
                                  WHERE screenId = :screenId');
        $this->db->bind(':screenId', $post['screenId']);
        $this->db->bind(':screenMainId', $post['mainId']);
        $this->db->bind(':screenLocation', $post['screenLocation']);
        $this->db->bind(':screenPath', $imgPath);
        return $this->db->execute();
    }
    public function deleteScreen($screenId){
        $this->db->query('UPDATE screens SET screenIsActive = 0 WHERE screenId = :screenId');
        $this->db->bind("screenId", $screenId);
        return $this->db->execute();
    }
}