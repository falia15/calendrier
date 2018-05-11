<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendrier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/calendar.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary mb-3">
        <a href="/index.php" class="navbar-brand">Mon calendrier</a>
    </nav>

<?php 

require('../src/Date/Month.php');

try {
    $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);

} catch(\Exception $e){
    $month = new App\Date\Month();
}
$day = $month->getStartingDate()->modify('last monday');

?>

    <h1><?= $month->toString(); ?></h1>

    <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
        <?php for($i = 0; $i < $month->getWeeks(); $i++): ?>
            <tr>
                <?php foreach($month->days as $day): ?>
                    <td><?= $day; ?></td>
                <?php endforeach ?>
            </tr>
            <?php endfor; ?>
    </table>
</body>
</html>