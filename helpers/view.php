<?php
    
function view(string $viewName, array $variable = [])
{
    $viewName = 'resources/views/' . str_replace('.', '/', $viewName) . '.php';
    
    if (!file_exists($viewName)) {
        die("Không tồn tại file view {$viewName}");
    }

    foreach ($variable as $key => $value) {
        $$key = $value;
    }
    
    return include_once $viewName;
}
