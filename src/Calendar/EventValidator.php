<?php

namespace Calendar;

class EventValidator extends Validator{

    public $errors = [];

    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data) {
        $this->name($data['name']);
        $this->date($data['date']);
        $this->start($data['start']);
        $this->end($data['end']);
        $this->description($data['description']);

        return $this->errors;
    }

    /**
     * @param string the name of the POST's data
     */
    public function name(string $data) {
        if(empty($data)){
            $this->errors[] = 'Le champ Titre doit être complété.';
            return;
        }

        if(!$this->minLenght($data)){
            $this->errors[] = 'Le champ Titre doit faire un minimum de 3 charactères.';
        }

        if(!$this->maxLenght($data)){
            $this->errors[] = 'Le champ Titre doit faire un maximum de 20 charactères.';
        }
    }

    /**
     * @param string
     */
    public function date(string $data) {
        if(empty($data)){
            $this->errors[] = 'Le champ Titre doit être complété.';
            return;
        }

        if(!$this->validDate($data)){
            $this->errors[] = 'Le champ Date selectionné est invalide.';
        }

    }

    /**
     * @param string
     */
    public function start(string $data){
        if(empty($data)){
            $this->errors[] = 'Le champ Démarrage doit être complété.';
            return;
        }

        if(!$this->validHour($data)){
            $this->errors[] = 'Le champ Démarrage est invalide.';
        }
    }

    /**
     * @param string
     */
    public function end(string $data){
        if(empty($data)){
            $this->errors[] = 'Le champ Fin doit être complété.';
            return;
        }

        if(!$this->validHour($data)){
            $this->errors[] = 'Le champ Fin est invalide.';
        }
    }

    /**
     * @param string
     */
    public function description(string $data) {
        if(empty($data)){
            return;
        }

        if(!$this->validText($data)){
            $this->errors[] = 'Le champ Description doit faire entre 2 et 200 charactères.';
        }
    }



}