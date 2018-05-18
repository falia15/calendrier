<?php

namespace Calendar;

class Events {

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * get all events between two dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventBetween(\DateTime $start, \DateTime $end) : array {
        
        // select all event bettwen the start and the end date
        $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();

        return $results;
    }

    public function getEventBetweenByDay(\DateTime $start, \DateTime $end) : array {
        $events = $this->getEventBetween($start, $end);
        $days = [];

        foreach($events as $event){
            $date = explode(' ', $event['start'])[0];

            if(!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }

        return $days;

    }


    /**
     * Get an evement
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function find(int $id) : \Calendar\PrintEvent {
        require('PrintEvent.php');
        $statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, \Calendar\PrintEvent::class);
        $result = $statement->fetch();

        if($result == false){
            throw new \Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }


}