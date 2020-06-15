<?php

require_once(__DIR__ . '/../services/newsservice.class.php');
require_once(__DIR__ . '/../models/news.class.php');
require_once(__DIR__ . '/../utils/helperutils.class.php');

// news: {
// 	"id":"2",
// 	"data":"Emergency",
// 	"code":null,
// }

// news: 
// {
// 	"data":"Emergency",
// 	"code":"imergency"
// }

class NewsRest {

	private $service;

	function __construct() {
		$this->service = new NewsService();
	}

	function process($method, $route, $request) {
		switch ($method) {
			case 'GET':
				return $this->doGet($route);
			case 'POST':
			case 'PUT':
			case 'DELETE':
			default:
				return array('status' => 405);
				break;
		}
	}

	function doGet($route) {
		// GET
		$id = isset($route[1]) ? $route[1] : null;
		$obj = $this->service->get($id);
		if (isset($obj)) {
			return $arr_json = array('status' => 200, 'news' => $obj);
		} else {
			return $arr_json = array('status' => 404);
		}

		return $arr_json = array('status' => 200, 'news' => $obj);
	}

}
