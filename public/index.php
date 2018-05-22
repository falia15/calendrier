<?php
require('../src/bootstrap.php');

if(isset($_GET['p']) && file_exists($_GET['p'] . '.php') && file_exists('../src/app/' . $_GET['p'] . '.php')){

    ob_start();
    require('../src/app/' . $_GET['p'] . '.php');
    require($_GET['p'] . '.php');
    $content = ob_get_clean();

} else {
    
    ob_start();
    require('../src/app/calendar.php');
    require('calendar.php');
    $content = ob_get_clean();
}

require('../views/layout.php');