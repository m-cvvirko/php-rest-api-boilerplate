<?php

require_once(__DIR__ . '/../connection/connection.class.php');
require_once(__DIR__ . '/../models/news.class.php');

class NewsRepository 
{
    private $db;
    private $tableName;
    
    function __construct()
	{
        $this->db = ConnectionDB::getInstance();
        $this->tableName = ConnectionDB::DB_NAME.".`news`";
	}

    function get($id) {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";
	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(":id", $id);
	    $stmt->execute();

        $obj = null;
	    if($stmt->rowCount() > 0)
	    {
	    	$obj  = $stmt->fetch(PDO::FETCH_OBJ);
        }
        return $obj;
    }

    function getByCode($id) {
        $sql = "SELECT * FROM $this->tableName WHERE code = :code";
	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(":code", $id);
	    $stmt->execute();

        $obj = null;
	    if($stmt->rowCount() > 0)
	    {
	    	$obj  = $stmt->fetch(PDO::FETCH_OBJ);
        }
        return $obj;
    }
    
    function getAll() {
        $sql = "SELECT * FROM $this->tableName";
	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();

        $objs = null;
	    if($stmt->rowCount() > 0)
	    {
	    	$objs  = $stmt->fetchAll(PDO::FETCH_CLASS, 'News');
        }
        return $objs;
    }

}
?>