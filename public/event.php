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

<h1><?= h($event->getName()); ?></h1>

<ul>
    <li>Date : <?= $event->getStart()->format('d/m/y'); ?></li>
    <li>Heure de démarrage : <?= $event->getStart()->format('H:i'); ?></li>
    <li>Heure de fin : <?= $event->getEnd()->format('H:i'); ?></li>
    <li>
    Description: <br>
    <?= h($event->getDescription()); ?>
    </li>
</ul>

<?php require('../views/footer.php');
