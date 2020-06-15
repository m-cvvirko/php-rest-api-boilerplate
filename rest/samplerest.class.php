<?php

require_once(__DIR__ . '/../services/sampleservice.class.php');
require_once(__DIR__ . '/../models/sample.class.php');
require_once(__DIR__ . '/../utils/helperutils.class.php');

// sample: {
// 	"id":"2",
// 	"data":"Emergency",
// 	"code":null,
// }

// sample: 
// {
// 	"data":"Emergency",
// 	"code":"imergency"
// }

class SampleRest {

	private $service;

	function __construct() {
		$this->service = new SampleService();
	}

	function process($method, $route, $request) {
		switch ($method) {
			case 'GET':
				return $this->doGet($route);
			case 'POST':
				return $this->doPost($route, $request);
			case 'PUT':
				return $this->doPut($route, $request);
			case 'DELETE':
					// return $arr_json = array('status' => 400);
				return $this->doDelete($route); 
			default:
				return array('status' => 405);
				break;
		}
	}

	function doGet($route) {
		//GET
		$id = isset($route[1]) ? $route[1] : null;
		$obj = $this->service->get($id);
		if (isset($obj)) {
			return $arr_json = array('status' => 200, 'sample' => $obj);
		} else {
			return $arr_json = array('status' => 404);
		}
	}

	function doPost($route, $request) {
		//POST
		if (empty($route[1])) {
			$sample = (new Sample())->mapFromRequest($request);
			$obj = $this->service->save($sample);
			if ( isset($obj)) {
				$route[1] = $obj->id;
				return $arr_json = array('status' => 200, 'resource' => $route.join('/'));
			} else {
				return $arr_json = array('status' => 400);
			}
		} else {
			return $arr_json = array('status' => 404);
		}
	}

	function doPut($route, $request) {
		//PUT
		if (!isset($route[1]) || empty($route[1]) || !is_numeric($route[1])) {
			return $arr_json = array('status' => 404);
		}
		$sample = new Sample(false);
		$sampleUpdate = HelperUtils::mergeObjectWithArray($sample, $request);
		$id = $route[1];
		$obj = $this->service->update($id, $sampleUpdate);
		if (isset($obj)) {
			return $arr_json = array('status' => 200, 'resource' => $route.join('/'));
		} else {
			return $arr_json = array('status' => 400);
		}
	}

	function doDelete($route){
		//DELETE should not be supported
		$obj = null;
		if(isset($route[1])) {
			$id = $route[1];
			$obj = $this->service->delete($id);
		}	
	    if(isset($obj))
	    {
			return $arr_json = array('status' => 200);
	    } else {
			return $arr_json = array('status' => 400);
	    }
	}
}
