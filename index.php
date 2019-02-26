<?php

/* 
 * ACME controller 
 */
require_once 'library/connections.php'; //get db connection (must be first)
require_once 'model/acme-model.php'; //get model (gets info from db)

//require_once brings code into scope

//get array of categories
$categories = getCategories();

//var_dump($categories);   // displays info about variable, array, or object
//echo '<pre>' . print_r($categories, true) . '</pre>';
//exit;   //stops further processing

//dynamic navigation
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/index.php?action=" . urlencode($category['categoryName']) . "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
    if( $action == NULL) {
        $action = 'home';
    }
}


switch ($action) {
    case 'home':
        include 'view/home.php';
        break;
    case 'login':
        include 'view/login.php';
        break;
    case 'register':
        include 'view/registration.php';
        break;
    case 'template':
        include 'template/template.php';
        break;
    case 'prodMgmt':
        include 'view/product-managment.php';
        break;
    default:
        include 'view/home.php';
}


/*      $action will store the the content 
 *      filter_input() sifts content to eliminate harmful code
 *      key/value pair watching for action to store value in $action variable
 */