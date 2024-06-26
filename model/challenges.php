<?php

class challenges extends Entity
{

    public $id;
    public $code;
    public $language;
    public $solution;
    public $difficulty;
    public $sourceLink;


    public function __construct($dbc){
        parent::__construct($dbc, 'challenges');
    }

    public function initFields(){
        $this->fields = ['id', 'language', 'code', 'solution', 'difficulty', 'sourceLink'];
    }
}