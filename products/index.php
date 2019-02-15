<?php

/*
 *  Products controller 
 */
require_once '../library/connections.php'; //get db connection (must be first)
require_once '../model/acme-model.php'; //get model (gets info from db)
require_once '../model/products-model.php'; //get model (gets info from db)
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
//dynamic drop-down select list
$catList = '<select name="categories">';
$catList .= '<option value="" selected disabled hidden>Select an option: </option>';
foreach ($categories as $category) {
    $catList .= '<option value="" ' . $category['categoryId'] . '>' . $category['categoryName'] . '</option>';
}
$catList .= '</select>';

//echo $catList;
//exit;



$action = filter_input(INPUT_POST, 'action');
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'prod-mgmt';
    }
}


switch ($action) {
    case 'prod-mgmt':
        include '../view/prod-mgmt.php';
        break;
    case 'new-prod':
        include '../view/new-prod';
        break;
    case 'new-cat':
        include '../view/new-cat';
        break;
    default:
        include '../view/prod-mgmt.php';
}
