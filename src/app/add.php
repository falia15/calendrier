<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $errors = [];
    $eventValidator = new Calendar\EventValidator();
    $errors = $eventValidator->validates($_POST);

    if(empty($errors)){
        $pdo = get_pdo();
        $event = new Calendar\Events($pdo);
        $event->saveEvent($_POST);
        $formFeedback = 'Nouvel évènement enregistré.';
    }

}