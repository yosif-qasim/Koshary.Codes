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
//        $this->findBy('id',$this->id);
    }

    public function increasePoints($points){
        // Update points and solved challenges
        $this->points += $points;
        $this->solvedChallenges += 1;

        // Prepare the SQL statement with placeholders
        $stmt = $this->dbc->prepare('UPDATE user SET points = ?, solvedChallenges = ? WHERE username = ?');

        // Execute the statement with the bound parameters
        $stmt->execute([$this->points, $this->solvedChallenges, $this->username]);
    }

    public function increaseSolvedChallenges(){

    }
}