<?php
//
//define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
//define('VIEW_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
//define('CONTROLLER_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
//define('MODEL_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
//
////echo "Test";
//$page = $_GET['page'] ?? 'home';
//
//if($page == 'home'){
//
//    include VIEW_PATH . 'index.html';
//
//}else{
//    echo '404';
//}


define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', ROOT_PATH . '..' . DIRECTORY_SEPARATOR.'controller' . DIRECTORY_SEPARATOR);
define('MODEL_PATH', ROOT_PATH . '..' . DIRECTORY_SEPARATOR .'model' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . '../src/template.php';

$page = $_GET['page'] ?? 'index';

// Sanitize input
$allowedPages = ['index', 'login', 'contact']; // Define allowed pages
$page = in_array($page, $allowedPages) ? $page : '404'; // Default to 404 if page not allowed



if ($page == 'index') {
    $template = new template('index');
    $template->viewPage('landingPage',["hero","features","testimonials","team", "contact"]);
} else if ($page == 'login') {
    $template = new template('index' );
    $template->viewPage('login',["loginForm"]);
} else if ($page == '404') {
    $template = new template('index');
    $template->viewPage('error',["404"]);
}

