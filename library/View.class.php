<?php

class View {

    public static $params = array();
    public static $alerts = array();

    public static function output($view) {

        if (!empty(self::$params)) {
            extract(self::$params,EXTR_OVERWRITE);
        }

        if (isset($alerts)) {
            foreach ($alerts as $type => $message) {
                echo "
                <div class='alert alert-$type fade in'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>$message
                </div>
                ";
            }
        }

        include TEMPLATE_PATH . $view . '.php';

    }

    public static function setParams($array) {
        self::$params = array_merge_recursive(self::$params, $array);
    }

    public static function setAlert($type, $alert) {
        $array = array($type => $alert);
        View::setParams(array('alerts' => $array));
    }

    public function readAlerts()
    {
        if (isset($danger)) {
            echo "
            <div class='alert alert-danger' role='alert'>
            <span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span>
            <span class='sr-only'>Error: </span>
            $danger
            </div>
            ";
        }

        if (isset($warning)) {
            echo "
            <div class='alert alert-warning' role='alert'>
            <span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span>
            <span class='sr-only'>Warning: </span>
            $warning
            </div>
            ";
        }

        if (isset($info)) {
            echo "
            <div class='alert alert-info' role='alert'>
            <span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>
            <span class='sr-only'>Info: </span>
            $info
            </div>
            ";
        }

        if (isset($success)) {
            echo "
            <div class='alert alert-success' role='alert'>
            <span class='glyphicon glyphicon-ok-sign' aria-hidden='true'></span>
            <span class='sr-only'>Success: </span>
            $success
            </div>
            ";
        }
    }
}
