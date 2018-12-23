<?php

ob_start();
session_start();

require_once 'helpers/view.php';
require_once 'helpers/var-dumper/dd.php';
require_once 'routes/web.php';

// Nhận đường dẫn từ URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/\\');
$arr_url = explode('/', $url);
$controller = '';
$action = '';
$method = '';
$params = [];

foreach (Route::$routes as $key => $route) {
    $arr_url_route = explode('/', trim($route['url'], '/\\'));

    // 2 mảng route_url và url bằng nhau tuyệt đối => route cần tìm => break
    if ($arr_url_route === $arr_url) {
        $controller = $route['controller'];
        $action = $route['action'];
        $method = $route['method'];
        break;
    }

    // mảng route_url có độ dài khác với độ dài mảng url hoặc có độ dài < 2 (khi nhỏ hơn 2 thì cần phải có so sánh tuyệt đối)
    $lengthRoute = count($arr_url_route);
    if (($lengthRoute !== count($arr_url)) || $lengthRoute < 2) {
        continue;
    }

    $param = []; // các biến được định nghĩa trong route_url
    $dem = 0; // tổng các phần tử giống nheu theo vị trí của 2 mảng url và route_url
    for ($i = 0; $i < $lengthRoute; $i++) {
        if ($arr_url_route[$i][0] === '{' && $arr_url_route[$i][-1] === '}') {
            $param[] = $arr_url[$i];
        }

        if ($arr_url_route[$i] === $arr_url[$i]) {
            $dem++;
        }
    }

    // số phần tử giống nhau theo vị trí + param = độ dài của 1 mảng url => có khả năng cao là url đúng
    if ($dem + count($param) === $lengthRoute) {
        // param càng ít thì route càng đúng => param của route lớn hơn => loại
        if ((count($params) > count($param)) || count($params) === 0) {
            $params = $param;
            $controller = $route['controller'];
            $action = $route['action'];
            $method = $route['method'];
            // chưa thể break, vì có thể tìm đc route chính xác hơn
        }
    }
}

if (empty($controller)) {
    die('ERROR: Không tồn tại URL');
}

$fileName = 'app/Controllers/' . ucfirst($controller) . '.php';
if (!file_exists($fileName)) {
    die("ERROR: Không tồn tại file <b>{$controller}</b>");
}

require_once "$fileName";
$object = new $controller;

if (!method_exists($object, $action)) {
    die("ERROR: Không tồn tại action <b>{$action}</b>");
}

call_user_func_array([$object, "$action"], $params); // truyền tất cả params vào phương thức $action của đối tượng $object
