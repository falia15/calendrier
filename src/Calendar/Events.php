<?php

namespace Calendar;

class Events {

    /**
     * get all events between two dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventBetween(\DateTime $start, \DateTime $end) : array {
        // datebase connexion, basic local configuration
        $pdo =  new \PDO('mysql:host=localhost;dbname=calendar', 'root', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
        
        // select all event bettwen the start and the end date
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll();

        return $results;
    }











}