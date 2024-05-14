<?php

class signupController
{
    public function defaultAction()
    {
        $template = new template('index');
        $template->viewPage('login', ["signupForm"], []);
        if($_POST['postAction'] ?? 0 == 1 ) {
            $this->signupAction();
        }
    }

    function signupAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        $username = $_POST['username'] ?? '';
        $password = hash_hmac("sha256", $_POST['password'], "k0sh4Ry") ?? '';

        $userObj = new user($dbc);
        $userObj->findBy('username', $username);

        if (!($userObj->id)&&$_POST['postAction'] ?? 0 == 1) {

            $stmt = $dbc->prepare('INSERT INTO user (username, password) VALUES (?,  ?)');
            if ($stmt->execute([$username, $password])) {
                //redierct to ./?page=login after signup
                header('Location: ./index.php?page=login');
                return 'User registered successfully!';
            } else {
                return 'Error occurred during registration.';
            }
        }else{
            echo "user already exist";
        }
    }
}