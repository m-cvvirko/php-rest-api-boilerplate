<?php

require_once(__DIR__ . '/../services/healthservice.class.php');

class HealthRest
{
	private $service;

	function __construct()
	{
		$this->service = new HealthService();
	}

	function process($method, $route){
		switch ($method) {
		case 'GET':
			return $this->doGet($route);
			break;
		default:
			return array('status' => 405);
      		break;
		}
	}

	function doGet($route){
		//GET
		$status = $this->repository->getStatus();
		if(isset($status)) 
	    {
            // echo $status;
            if($route[0] == 'ping') {
                return $arr_json = array('pong' => 'OK' );
            } else {
                return $arr_json = array('status' => 200, 'health' => 'OK' );
            }
	    } else {
			return $arr_json = array('status' => 404);
	    }
	}
}
?>