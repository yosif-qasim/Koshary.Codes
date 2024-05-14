<?php

class loginController
{
    public function defaultAction()
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Display the login page
        $template = new template('index');
        $template->viewPage('login', ["loginForm"], []);

        // Check if the login form was submitted
        if ($_POST['postAction'] ?? 0 == 1) {
            $this->loginAction();
        }
    }

    function loginAction()
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the form was submitted
        if ($_POST['postAction'] ?? 0 == 1) {
            // Retrieve and sanitize user inputs
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $password = htmlspecialchars(trim($_POST['password'] ?? ''));

            // Store the username in the session
            $_SESSION['userName'] = $username;

            // Initialize authentication class
            $auth = new auth();

            // Check credentials
            if ($auth->checkLogin($username, $password)) {
//                // Login successful, set session and redirect

                $dbh = DatabaseConnection::getInstance();
                $dbc = $dbh->getConnection();

                $userObj = new user($dbc);
                $userObj->findBy('username', $username);
                $_SESSION['userId'] = $userObj->id;

                header('Location: http://localhost:63342/koshary.codes/public/?page=challenges&challengeId=1');
                exit(); // Ensure immediate exit after redirect
            } else {
                // Generic error message to avoid hinting at whether username or password was incorrect
                echo "Invalid credentials, please try again.";
            }
        }
        ob_end_flush();
    }
}
