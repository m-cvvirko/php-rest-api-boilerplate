<?php

require_once(__DIR__ . '/../connection/connection.class.php');
require_once(__DIR__ . '/../models/sample.class.php');

class SampleRepository 
{
    private $db;
    private $tableName;
    
    function __construct()
	{
        $this->db = ConnectionDB::getInstance();
        $this->tableName = ConnectionDB::DB_NAME.".`sample`";
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

    function getByCode($code) {
        $sql = "SELECT * FROM $this->tableName WHERE code = :code";
	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(":code", $code);
	    $stmt->execute();

        $obj = null;
	    if($stmt->rowCount() > 0)
	    {
	    	$obj  = $stmt->fetch(PDO::FETCH_OBJ);
        }
        return $obj;
    }

    public function getByIdAndCode($id, $code) {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id AND code = :code";
	    $stmt = $this->db->prepare($sql);
	    $stmt->bindValue(":id", $id);
	    $stmt->bindValue(":code", $code);
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
	    	$objs  = $stmt->fetchAll(PDO::FETCH_CLASS, 'Sample');
        }
        return $objs;
    }

    function insert($sample) {
        if(!isset($sample->code)) {
            return null;
        }
        $withDataName = isset($sample->data) ? 'data, ' : '';
        $withDataValue = isset($sample->data) ? ':data, ' : '';
        
        $sql = "INSERT $this->tableName ($withDataName code)";
        $sql .= " VALUES ($withDataValue :code)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', $sample->code);
        if (isset($sample->data)) $stmt->bindValue(':data', $sample->data);
        $stmt->bindValue(':code', $sample->code);
        $stmt->execute();

        $obj = null;
        if ($stmt->rowCount() > 0) {
            $id = $this->db->lastInsertId();
            $obj = $this->get($id);
        }
        return $obj;
    }

    function update($sample) {
        if(!isset($sample->id)) {
            return null;
        }
        $withs = [];
        if (isset($sample->data)) $withs['data'] = ':data';
        if (isset($sample->code)) $withs['code'] = ':code';

        if(count($withs) == 0) {
            return null;
        } 

        $sql = "UPDATE $this->tableName SET "; 
        $commCnt = 0;
        foreach($withs as $rn => $rv) {
            $sql .= " $rn = $rv ";
            if (++$commCnt < count($withs)) {
                $sql .= ",";
            }
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        if (isset($sample->data)) $stmt->bindValue(':data', $sample->data);
        if (isset($sample->code)) $stmt->bindValue(':code', $sample->code);
        $stmt->bindValue(":id", $sample->id);
        $stmt->execute();

        $obj = null;
        if ($stmt->rowCount() > 0) {
            $obj = $this->get($sample->id);
        }
        return $obj; 
    }

    function delete($id) {
        $sampleToRemove = $this->get($id);
        if(isset($sampleToRemove)) {
            $sql = "DELETE FROM $this->tableName WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return ($stmt->rowCount() > 0) ? $sampleToRemove : null;
        }
        return null;
    }
}
?>