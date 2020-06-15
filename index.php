<?php
	define("APPL", "appl");
	define("API", "api");

	ini_set('display_errors', 1); 
	ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	
	$route 	= $_SERVER['REQUEST_URI'];
	$method = $_SERVER['REQUEST_METHOD'];

	$route = substr($route, 1);
	$route = explode("?", $route);
	$route = explode("/", $route[0]);
	$route = array_diff($route, array(APPL, API));
	$route = array_values($route);

	$arr_json = null;

	if (count($route) <= 2) {
		$params = (array) json_decode(file_get_contents('php://input'), TRUE);

		switch ($route[0]) {
			case 'news':
				include(__DIR__ . '/./rest/newsrest.class.php');
				$rest = new NewsRest();
				$arr_json = $rest->process($method, $route, $params);
				break;

			case 'sample':
				include(__DIR__ . '/./rest/samplerest.class.php');
				$rest = new SampleRest();
				$arr_json = $rest->process($method, $route, $params);
				break;

			case 'ping':
			case 'health':
				include(__DIR__ . '/./rest/healthrest.class.php');
				$healthRest = new HealthRest();
				$arr_json = $healthRest->process($method, $route);
				//$arr_json = array('health' => 200);
				break;

			default:
				$arr_json = array('status' => 404);
				break;
		}
	} else {
		$arr_json = array('status' => 404);
	}
	header("Content-Type: text/json; charset=utf-8");
	echo json_encode($arr_json);
