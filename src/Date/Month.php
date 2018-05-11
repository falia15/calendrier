<?php

namespace App\Date;

class Month {

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
    private $month;
    private $year;
    /**
     * @param int $month, the month between 1 and 12
     * @param int $year
     * @throws \Exception
     */
    public function __construct($month = null, $year = null) 
    {
        if($month === null){
            $month = intval(date('m'));
        }

        if($year === null){
            $year = intval(date('Y'));
        }

        if($month < 1 || $month > 12){
            throw new \Exception("The month $month is unvalaible");
        }

        $this->month = $month;
        $this->year = $year;

    }

    public function getStartingDate(): \DateTime {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    public function toString(): string
    {
        return $this->months[$this->month -1] . ' ' . $this->year;
    }

    public function getWeeks(): int {
        $start = $this->getStartingDate();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W')) +1;
        if($weeks < 0){
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }






}