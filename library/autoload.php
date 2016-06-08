<?php

function __autoload($class_name) {

    if (substr_count($class_name, 'Controller')) {
        include_once './controller/' . $class_name . '.class.php';
    } elseif (substr_count($class_name, 'Model')) {
        include_once './model/' . $class_name . '.class.php';
    } elseif (substr_count($class_name, 'Object')) {
        include_once './object/' . $class_name . '.class.php';
    } else {
        include_once './library/' . $class_name . '.class.php';
    }
}

?>
