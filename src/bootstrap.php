<?php
require('../vendor/autoload.php');
// instantiate
$loader = new \Aura\Autoload\Loader;

// append to the SPL autoloader stack; use register(true) to prepend instead
$loader->register();
$loader->addPrefix('Calendar', '../src/Calendar');

function get_pdo() : PDO {
    $config = json_decode(file_get_contents('../src/config/config.json'));
    return $pdo =  new PDO("mysql:host=localhost;dbname=$config->dbname", "$config->dblogin", "$config->dbpass", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

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

function e404() {
    header('location: 404.php');
}