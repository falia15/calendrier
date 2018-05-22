<?php 

require('../src/Calendar/Events.php');
$pdo = get_pdo();
$events = new Calendar\Events($pdo);

if(!isset($_GET['id'])){
    e404();
}
try {
    $event = $events->find($_GET['id']);
} catch (\Exception $e) {
    e404();
}

?>