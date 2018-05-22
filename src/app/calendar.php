<?php 

$pdo = get_pdo();
$events = new Calendar\Events($pdo);
$month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
$start = $month->getStartingDate();
$weeks = $month->getWeeks();

// if the first day of the month is not monday, get the monday of the first week of the month, so the calendar will always start with a monday
$start = $start->format('N') === '1' ? $start : $month->getStartingDate()->modify('last monday');
$end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . ' days');

$events = $events->getEventBetweenByDay($start, $end);

?>
