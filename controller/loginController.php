<?php

class loginController
{
    public function defaultAction()
    {
        $template = new template('index');
        $template->viewPage('login', ["loginForm"], []);
        if($_POST['postAction'] ?? 0 == 1) {
            $this->loginAction();
        }
    }

    function loginAction()
    {
        if ($_POST['postAction'] ?? 0 == 1) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $auth = new auth();
            if ($auth->checkLogin($username, $password)) {
                $_SESSION['user_login'] = 1;
//                header('Location: ./index.php?page=challenges');
                echo "password  match";

                exit();
            }else{
                echo "user not found";
            }

        }
    }
}