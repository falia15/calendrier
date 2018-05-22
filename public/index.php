<?php 

require('../src/bootstrap.php');

$pdo = get_pdo();
$events = new Calendar\Events($pdo);
$month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDate();
$weeks = $month->getWeeks();

// if the first day of the month is not monday, get the monday of the first week of the month, so the calendar will always start with a monday
$start = $start->format('N') === '1' ? $start : $month->getStartingDate()->modify('last monday');
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . ' days');

$events = $events->getEventBetweenByDay($start, $end);

require('../views/header.php');
?>

<!-- Title and previous and next buttons -->
<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h1><?= $month->toString(); ?></h1>
    <div>
        <a href="/index.php?month=<?= $month->previousMonth()->month ?>&year=<?=  $month->previousMonth()->year ?>" class="btn btn-primary">&lt;</a>
        <a href="/index.php?month=<?= $month->nextMonth()->month ?>&year=<?=  $month->nextMonth()->year ?>" class="btn btn-primary">&gt;</a>
    </div>
</div>

<!-- Calendar -->
<table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
    <?php for($i = 0; $i < $weeks; $i++): ?>

        <tr>
            <?php foreach($month->days as $k => $day):
                $date = (clone $start)->modify("+" . ($k + $i * 7). "days");
                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                ?>
                <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>" >
                    <?php if($i === 0): ?>
                        <div class="calendar__weekday"><?= $day; ?></div>
                    <?php endif; ?>
                    <div class="calendar__day"><?= $date->format('d'); ?></div>

                    <?php foreach($eventsForDay as $event) : ?>
                        <?= (new DateTime($event['start']))->format('H:i') ?> - <a href="/event.php?id=<?= $event['id']; ?>"><?= h($event['name']); ?></a>
                    <?php endforeach ?>
                </td>
            <?php endforeach ?>
        </tr>

    <?php endfor; ?>
</table>
<?php require('../views/footer.php');
