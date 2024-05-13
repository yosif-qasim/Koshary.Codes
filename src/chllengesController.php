<?php

class chllengesController extends Entity{

    public function __construct($dbc){
        parent::__construct($dbc, 'challenges');
    }

    public function initFields(){
        $this->fields = ['id', 'language', 'code', 'solution', 'difficulty', 'sourceLink'];
    }
}