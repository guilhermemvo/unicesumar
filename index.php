<?php

include_once './library/configure.php';
include_once './library/functions.php';
include_once './library/autoload.php';
include_once './view/templates/default/commons/top.php';

if (!empty($_GET['class'])) {

    $class = $_GET['class'] . 'Controller';
    $class = new $class();

    if ($_GET['function']) {
        $function = $_GET['function'];

        if (!empty($_GET['id'])) {
            $class->$function($_GET['id']);
        } else {
            $class->$function();
        }
    }
} else {
    include './view/templates/default/index.php';
}

include './view/templates/default/commons/bottom.php';
