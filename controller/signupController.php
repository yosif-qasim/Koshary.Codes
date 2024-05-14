<?php

class signupController
{
    public function defaultAction()
    {
        $template = new template('index');
        $template->viewPage('login', ["signupForm"], []);
        if($_POST['postAction'] ?? 0 == 1) {
            $this->loginAction();
        }
    }

    function loginAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        if ($_POST['postAction'] ?? 0 == 1) {
            $username = $_POST['username'] ?? '';
            $password = hash_hmac("sha256", $_POST['password'], "k0sh4Ry") ?? '';
            $stmt = $dbc->prepare('INSERT INTO user (username, password) VALUES (?,  ?)');
            if ($stmt->execute([$username, $password])) {
                return 'User registered successfully!';
            } else {
                return 'Error occurred during registration.';
            }
        }
    }
}