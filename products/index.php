<?php

/* 
 *  Products controller 
 */
require_once '../library/connections.php'; //get db connection (must be first)
require_once '../model/acme-model.php'; //get model (gets info from db)

// TODO: use the products model which hasn't been created yet
//TODO: create the catlist variable to build a drop down select list, category name must appear but the value shoudl be the category id
// TODO: use the catlist variable in the add product view

//get array of products - db column invName
$invName = getInvName();

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
}


switch ($action) {
    case 'something':
        
        break;
    case '':
        include '';
        break;

    default:
        include '../view/prod-mgmt.php';
}
