<!-- Title and previous and next buttons -->
<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
    <h1><?= $month->toString(); ?></h1>
    <div>
        <a href="/index.php?p=add">Créer un évenement</a>
        <a href="/index.php?month=<?= $month->previousMonth()->month ?>&year=<?=  $month->previousMonth()->year ?>" class="btn btn-primary">&lt;</a>
        <a href="/index.php?month=<?= $month->nextMonth()->month ?>&year=<?=  $month->nextMonth()->year ?>" class="btn btn-primary">&gt;</a>
    </div>
</div>
<div>
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
                        <?= (new DateTime($event['start']))->format('H:i') ?> - <a href="/index.php?p=event&id=<?= $event['id']; ?>"><?= h($event['name']); ?></a>
                    <?php endforeach ?>
                </td>
            <?php endforeach ?>
        </tr>

    <?php endfor; ?>
</table>

