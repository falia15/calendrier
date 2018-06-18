<?php

namespace Calendar;

use Calendar\PrintEvent;

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

    /**
     * sort in an array, evenements by their date
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
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
        $statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, \Calendar\PrintEvent::class);
        $result = $statement->fetch();

        if($result == false){
            throw new \Exception('Aucun résultat n\'a été trouvé');
        }
        return $result;
    }

    public function saveEvent(array $data){
        $req = $this->pdo->prepare('INSERT INTO events (name, description, start, end) VALUES (:name, :description, :start, :end)');
        $req->execute(array(
            'name' => $data['name'],
            'description' => $data['description'],
            'start' => $data['date'] . ' ' . $data['start'] . ':00',
            'end' => $data['date'] . ' ' . $data['end'] . ':00'
        ));
    }
}