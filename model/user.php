<?php

class user extends Entity {


    public $id;
    public $username;
    public $password;
    public $solvedChallenges;
    public $points;

    public function __construct($dbc){
        parent::__construct($dbc, 'user');
    }

    public function initFields(){
        $this->fields = ['id', 'username', 'password', 'solvedChallenges', 'points'];
    }
}