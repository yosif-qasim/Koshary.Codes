<?php

class auth
{
     public function checkLogin($username, $password)
     {
         $dbh = DatabaseConnection::getInstance();
         $dbc = $dbh->getConnection();

         $userObj = new user($dbc);
         $userObj->findBy('username', $username);

            if($userObj->id){
                echo "user found" . "<br>";
                if($userObj->password===$password){
                    echo "password correct " . "<br>";
                    return true;
                }
            }

     }

     public function logout()
     {
          session_destroy();
     }


}