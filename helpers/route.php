<?php 

class Route
{
	public static $routes = [];

	public static function get($url, $route)
	{
		[$controller, $action] = explode('@', $route);
		self::$routes[] = ['url' => $url, 'controller' => $controller, 'action' => $action, 'method' => 'GET'];
	}

	public static function post($url, $route)
	{
		[$controller, $action] = explode('@', $route);
		self::$routes[] = ['url' => $url, 'controller' => $controller, 'action' => $action, 'method' => 'POST'];
	}

}