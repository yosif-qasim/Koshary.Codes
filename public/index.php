<?php

session_start();

ob_start();
$_SESSION['challengesSoleved'] = 0;
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', ROOT_PATH . '..' . DIRECTORY_SEPARATOR.'controller' . DIRECTORY_SEPARATOR);
define('MODEL_PATH', ROOT_PATH . '..' . DIRECTORY_SEPARATOR .'model' . DIRECTORY_SEPARATOR);



require_once ROOT_PATH . '../src/auth.php';
require_once ROOT_PATH . '../src/Entity.php';
require_once ROOT_PATH . '../src/template.php';
require_once ROOT_PATH . '../src/databaseConnection.php';

require_once ROOT_PATH . '../model/user.php';
require_once ROOT_PATH . '../model/challenges.php';

require_once ROOT_PATH . '../controller/loginController.php';
require_once ROOT_PATH . '../controller/signupController.php';
require_once ROOT_PATH . '../controller/chllengesController.php';
require_once ROOT_PATH . '../controller/leaderboardController.php';


$page = $_GET['page'] ?? 'index';
$challengeId = $_GET['challengeId'] ?? '1';

databaseConnection::connect('127.0.0.1', '3306','kosharyCodes', 'root', '');
$dbh = databaseConnection::getInstance();
$dbc = $dbh->getConnection();

// Sanitize input
$allowedPages = ['index', 'login', 'signup', 'contact','challenges','leaderboard','logout']; // Define allowed pages
$page = in_array($page, $allowedPages) ? $page : '404'; // Default to 404 if page not allowed

if ($page == 'index') {
    $template = new template('index');
    $template->viewPage('landingPage',["hero","features","team"],[]);
} else if ($page == 'login') {
//    $template = new template('index' );
//    $template->viewPage('login',["loginForm"],[]);
    session_start();
    $loginPage = new loginController();
    $loginPage->defaultAction();
}else if ($page == 'signup') {
//    $template = new template('index' );
//    $template->viewPage('login',["loginForm"],[]);
    $signupPage = new signupController();
    $signupPage->defaultAction();
} else if ($page == 'challenges') {
    $challengePage = new chllengesController($dbc);
    $challengePage->defaultAction($challengeId);
} else if($page == 'leaderboard'){
    $leaderboardPage = new leaderboardController();
    $leaderboardPage->defaultAction();
}else if($page == 'logout'){
    session_destroy();
    header('Location: ./index.php?page=login');
    exit();

}else if ($page == '404') {
    $template = new template('index');
    $template->viewPage('error',["404"] ,[]);
}

