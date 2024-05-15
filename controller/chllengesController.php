<?php

class chllengesController {


    private user $userObj;

    public function defaultAction($id){

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        $this->userObj = new user($dbc);
        $this->userObj->findBy('id', $_SESSION['userId']);

        $challengeObj = new challenges($dbc);
        $challengeObj->findBy('id', $id);

        $variabels['challenge'] = $challengeObj;

        $template = new template('index' );
        $template->viewPage('challenges',["challengeNavbar","codeSnippet"], $variabels);

        $this->solutionHandel($challengeObj);
        if($this->userObj->points == 30){
            $this->createCertificate();
        }
    }

    public function solutionHandel($challengeObj){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $challengeId = htmlspecialchars($_POST['challengeId']);
            $solutionLine = htmlspecialchars($_POST['solutionLine']);
            $solutionType = htmlspecialchars($_POST['solutionType']);
            if($solutionLine== $challengeObj->solution){
//                $_SESSION['challengesSoleved'] += 1;
                $this->userObj->increasePoints(10);
                echo "challenges solved = ". $this->userObj->points . "<br>";
                echo "<div class=\"row text-center \">
                      <div class=\" col-md-4 \" >
                      </div>
                       <div class=\"alert col-md-4 text-center alert-success\" role=\"alert\">
                        Correct solution !!!!!

                        <div class=\"alert alert-primary\" role=\"alert\">
                     code source : <a href=\"" . $challengeObj->sourceLink. "\">" . $challengeObj->sourceLink ."</a>
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
    }

    public function createCertificate()
    {
//        echo "image ready !!" . "<br>" . "<a href=\"./view/assets/images/new_CERT.png\">download certificate</a>";
        echo "<div class=\" text-center position-absolute bottom-0 start-50 translate-middle-x  \">
                      <div class=\" col-md-4 \" >
                      </div>
                       <div class=\"alert col-md-12 text-center alert-success\" role=\"alert\">
                        <h4 class=\"alert-heading\">Well done!</h4> Certificate ready !!" . "<br>" . "<a href=\"./view/assets/images/new_CERT.png\">download certificate</a>
                    </div>
                                          <div class=\" col-md-4 \" >
                      </div>
                    </div>";
        $image = imagecreatefrompng("./view/assets/images/CERT.png");
        $color = imagecolorallocate($image, 0, 0, 200);
        $font = './roboto.ttf';
        $text = $_SESSION['userName'];
        $maxWidth = 500;
        if (strlen($text) > $maxWidth) {
            $text = substr($text, 0, $maxWidth) . "...";
        }
        imagettftext($image, 45, 0, 600, 600, $color, $font, $text);
        imagepng($image, "./view/assets/images/new_CERT.png");
        imagedestroy($image);
    }



}