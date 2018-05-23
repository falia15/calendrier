<?php

namespace Calendar;

class Validator {

    /**
     * @param string
     * @return bool
     */
    protected function minLenght($string) : bool {
        return strlen($string) >= 3;
    }

    /**
     * @param string
     * @return bool
     */
    protected function maxLenght($string) : bool {
        return strlen($string) <= 20;
    }

    /**
     * @param string $date format year-month-day
     * @return bool
     */
    protected function validDate(string $date) : bool {
        $date = explode('-', $date);
        // the format checkdate use is month/day/year
        return checkdate($date[1], $date[2], $date[0]);
    }

    /**
     * @param string
     * @return bool
     */
    protected function validHour(string $hour) : bool {
        $dateObject = \DateTime::createFromFormat("H:i", $hour);
        if($dateObject !== false){
            return true;
        }
        return false;
    }

    /**
     * @param string
     * @return bool
     */
    protected function validText(string $text) : bool {
        return strlen($text) > 2 && strlen($text) < 200;
    }


}