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

