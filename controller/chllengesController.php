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
        $this->solutionHandel();


    }

    public function solutionHandel(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $challengeId = htmlspecialchars($_POST['challengeId']);
            $solutionLine = htmlspecialchars($_POST['solutionLine']);
            $solutionType = htmlspecialchars($_POST['solutionType']);
            if($solutionLine== $this->solution){
                echo "<div class=\"row text-center \">
                      <div class=\" col-md-4 \" >
                      </div>
                       <div class=\"alert col-md-4 text-center alert-success\" role=\"alert\">
                        Correct solution !!!!!

                        <div class=\"alert alert-primary\" role=\"alert\">
                     code source : <a href=\"" . $this->sourceLink. "\">" . $this->sourceLink ."</a>
                    </div> 
                    </div>
                                          <div class=\" col-md-4 \" >
                      </div>
                    </div>";
            }else{
                echo "<div class=\"row text-center \">
                      <div class=\" col-md-4 \" >
                      </div>
                       <div class=\"alert col-md-4 text-center alert-danger\" role=\"alert\">
                        Wrong solution !!!!!
                    </div>
                                          <div class=\" col-md-4 \" >
                      </div>
                    </div>";
            }
        }
//        header("Location: ./koshary.codes/public/?page=challenges&challengeId=$challengeId");

    }



}