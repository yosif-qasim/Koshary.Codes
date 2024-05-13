<?php

class chllengesController extends Entity{

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

    public function defaultAction($id){
        $this->findBy('id', $id);
        $variabels['challenge'] = $this;
        $template = new template('index' );
        $template->viewPage('challenges',["challengeNavbar","codeSnippet"], $variabels);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $challengeId = htmlspecialchars($_POST['challengeId']);
            $solutionLine = htmlspecialchars($_POST['solutionLine']);
            $solutionType = htmlspecialchars($_POST['solutionType']);
            if($solutionLine== 5){
                echo "correct";
                echo "correct";
                echo "correct";
                echo "correct";
                echo "correct";
                echo "correct";
                echo "correct";
                echo "correct";
                echo "correct";
            }
            //
//            echo "ch id" . $challengeId . "<br>";
//            echo "sol line" . $solutionLine . "<br>";
//            echo "sol type" . $solutionType . "<br>";
            header("Location: /koshary.codes/public/?page=challenges&challengeId=$challengeId");

        }
    }

    public function navChallenge(){

    }



}