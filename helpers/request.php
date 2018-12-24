<?php

function request()
{
	return $_SERVER['REQUEST_METHOD'];
}


class Request
{
	public $data;

	public function get($data)
	{
		if (isset($_REQUEST[$data])) {
			return $_REQUEST[$data];
		}

		return null;
	}

	public function all()
	{
		unset($_REQUEST['url']);
		return $_REQUEST;
	}

	public function only(array $arr)
	{
		foreach ($arr as $value) {
			if (isset($_REQUEST[$value])) {
				$this->data[$value] = $_REQUEST[$value];
			}
		}
		
		return $this->data;
	}
}