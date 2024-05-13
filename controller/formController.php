<?php

//class formController
//{
//
//    public function formAction()
//    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $challengeId = htmlspecialchars($_POST['challengeId']);
            $solutionLine = htmlspecialchars($_POST['solutionLine']);
            $solutionType = htmlspecialchars($_POST['solutionType']);
//
//            echo "ch id" . $challengeId . "<br>";
//            echo "sol line" . $solutionLine . "<br>";
//            echo "sol type" . $solutionType . "<br>";
            header("Location: /koshary.codes/public/?page=challenges&challengeId=$challengeId");
        }
//    }
//}