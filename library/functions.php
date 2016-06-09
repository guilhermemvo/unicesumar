<?php

function dateToEn($data)
{
    $data = explode("/", $data);
    list($day, $month, $year) = $data;
    $date = "$year-$month-$day";
    return $date;
}

function dateToBr($date)
{
    $date = explode("-", $date);
    list($ano, $mes, $dia) = $date;
    $data = "$dia/$mes/$ano";
    return $data;
}

function sanitizeCaracters(&$string)
{
    $string = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ) );
}
