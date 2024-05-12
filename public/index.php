<?php

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', ROOT_PATH . '..' . DIRECTORY_SEPARATOR.'controller' . DIRECTORY_SEPARATOR);
define('MODEL_PATH', ROOT_PATH . '..' . DIRECTORY_SEPARATOR .'model' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . '../src/template.php';

$page = $_GET['page'] ?? 'index';

// Sanitize input
$allowedPages = ['index', 'login', 'contact','challenges']; // Define allowed pages
$page = in_array($page, $allowedPages) ? $page : '404'; // Default to 404 if page not allowed



if ($page == 'index') {
    $template = new template('index');
    $template->viewPage('landingPage',["hero","features","testimonials","team", "contact"]);
} else if ($page == 'login') {
    $template = new template('index' );
    $template->viewPage('login',["loginForm"]);
} else if ($page == 'challenges') {

    $template = new template('index' );
    $template->viewPage('challenges',["challengeNavbar","codeSnippet"]);
} else if ($page == '404') {
    $template = new template('index');
    $template->viewPage('error',["404"]);
}

