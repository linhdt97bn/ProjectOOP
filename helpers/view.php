<?php
	
function view(string $viewName, array $variable = [])
{
	$viewName = 'views/layouts/' . str_replace('.', '/', $viewName) . '.php';
	
	if (!file_exists($viewName)) {
		die('Không tồn tại file view');
	}

	foreach ($variable as $key => $value) {
	  	$$key = $value;
	}
	return include $viewName;
}