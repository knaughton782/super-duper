<?php

/* 
 * ACME controller 
 */
require_once 'library/connections.php'; //get db connection (must be first)
require_once 'model/acme-model.php'; //get model (gets info from db)
require_once 'library/functions.php'; //brings functions into scope

$categories = getCategories();
$navList = navList($categories);

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