<?php
	
function dd($variable = '')
{
    if (is_null($variable)) {
        echo 'null';
        die();
    }

    if (is_numeric($variable)) {
        echo $variable;
        die();
    }

    if (is_array($variable)) {
        echo "<pre>";
        print_r($variable);
        die();
    }

    if (is_string($variable)) {
        echo "\"$variable\"";
        die();
    }

    if (is_object($variable)) {
        echo "<pre>";
        print_r(json_decode(json_encode($variable)));
        die();
    }

    if ($variable === true) {
        echo 'true';
        die();
    }

    if ($variable === false) {
        echo 'false';
        die();
    }

    echo "<pre>";
    var_dump($variable);
    die();
}