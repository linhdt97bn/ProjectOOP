<?php
	
ob_start();
session_start();

require_once('helpers/view.php');
require_once('helpers/dd.php');
require_once('routes.php');
// require_once('config/database.php');
// Database::connect();

// Nhận đường dẫn từ URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/\\');
$arr_url = explode('/', $url);
$controller = '';
$action = '';
$method = '';
$params = [];

foreach (Route::$routes as $key => $route) {
	$param = [];
	$arr_url_route = explode('/', trim($route['url'], '/\\'));

	if ($arr_url_route === $arr_url) {
		$controller = $route['controller'];
		$action = $route['action'];
		$method = $route['method'];
		break;
	}

	// route có độ dài khác với độ dài url truyền vào hoặc có độ dài < 2 (khi nhỏ hơn 2 thì cần phải có so sánh tuyệt đối)=> duyệt route khác
	$length = count($arr_url_route);
	if (($length !== count($arr_url)) || $length < 2) {
		continue;
	}

	for ($i = 0; $i < $length; $i++) {
		if ($arr_url_route[$i][0] === '{' && $arr_url_route[$i][-1] === '}') {
			$param[] = $arr_url[$i];
		}
	}

	// tổng số phần tử trùng nhau + tổng biến truyền vào từ route = đô dài mảng route => khả năng cao
	if (count(array_intersect($arr_url_route, $arr_url)) + count($param) === $length) {
		$params = $param;
		$controller = $route['controller'];
		$action = $route['action'];
		$method = $route['method'];
		// chưa thể break, vì có thể tìm đc route chính xác hơn
	}
	$param = [];
}

if (empty($controller)) {
	die('ERROR: Không tồn tại URL');
}

$fileName = 'controllers/' . ucfirst($controller) . '.php';
if (!file_exists($fileName)) {
	die("ERROR: Không tồn tại file {$controller}");
}

include($fileName);
$className = ucfirst($controller);
$object = new $className;

if (!method_exists($object, $action)) {
	die("ERROR: Không tồn tại action {$action}");
}

if (!empty($params)) {
	call_user_func_array([$object, "$action"], $params); // truyền count($param) param vào phương thức $action của đối tượng $object
} else {
	$object->$action();
}
