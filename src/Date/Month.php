<?php

namespace App\Date;

class Month {

    /**
     * @return array
     */
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    /**
     * @return array
     */
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    /**
     * @return int
     */
    public $month;

    /**
     * @return int
     */
    public $year;

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

    /**
     * get the starting day of the month
     * @return dateTime
     */
    public function getStartingDate(): \DateTime {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * get the month and the year as a sentence
     * @return string
     */
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

    public function withinMonth(\DateTime $date): bool {
        return $this->getStartingDate()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * get next month
     * @return Month
     */
    public function nextMonth() : Month {
        $month = $this->month + 1;
        $year = $this->year;

        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);

    }

    /**
     * get previous month
     * @return Month
     */
    public function previousMonth() : Month {
        $month = $this->month - 1;
        $year = $this->year;
        
        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);

    }








}