<?php

require_once(__DIR__ . '/../connection/connection.class.php');

class Repository 
{
    private $db;
    
    function __construct()
	{
		$this->db = ConnectionDB::getInstance();
	}

    public function getStatus() {
        return $this->db->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }

}
?>