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


$page = $_GET['page'] ?? 'index';

// Sanitize input
$allowedPages = ['index', 'about', 'contact']; // Define allowed pages
$page = in_array($page, $allowedPages) ? $page : '404'; // Default to 404 if page not allowed

// Load view based on page
$viewFile = VIEW_PATH . $page . '.html';
if (file_exists($viewFile)) {
    include $viewFile;
} else {
    // Handle 404
    include VIEW_PATH . '404.html';
}