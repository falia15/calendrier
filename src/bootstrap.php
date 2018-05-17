<?php

function dd(...$vars){
    foreach($vars as $var){
        echo '<pre>';
        print_r($var);
        echo '<prev>';
    }
}

function h($value) : string {
    if($value === null){
        return '';
    }
    return htmlentities($value);
}

function get_pdo() : PDO {
    return $pdo =  new PDO('mysql:host=localhost;dbname=calendar', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

function e404() {
    header('location: 404.php');
}