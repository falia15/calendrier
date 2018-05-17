<?php 

require('../src/Calendar/Events.php');
require('../views/header.php');
require('../src/bootstrap.php');
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

<h1><?= h($event['name']); ?></h1>

<ul>
    <li>Date : <?= (new DateTime($event['start']))->format('d/m/y'); ?></li>
    <li>Heure de démarrage : <?= (new DateTime($event['start']))->format('H:i'); ?></li>
    <li>Heure de fin : <?= (new DateTime($event['end']))->format('H:i'); ?></li>
    <li>
    Description: <br>
    <?= h($event['description']); ?>
    </li>
</ul>

<?php require('../views/footer.php');
