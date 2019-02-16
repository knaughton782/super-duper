<?php

/*
 *  Products controller 
 */
require_once '../library/connections.php'; //get db connection (must be first)
require_once '../model/acme-model.php'; //get model (gets info from db)
require_once '../model/products-model.php'; //get model (gets info from db)

// TODO: use the catlist variable in the add product view
//get array of products - db column invName


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


//watching for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'prod-mgmt';
    }
}

//TODO: FIX REGOUTCOME VARIABLE

switch ($action) {
     case 'add-category':
//        echo 'You are hoping for the new category page'; 
//        exit;
        $categoryName = filter_input(INPUT_POST, 'categoryName');
               
        if (empty($categoryName)) {
            $message = '<p>All form fields are required. Please provide complete information.</p>';
            include '../view/add-category.php';
            exit;
        }
        
        //call the function and send info to model
        $regOutcome = regCategory($categoryName);
        //TODO: chg function to match category instead of register
                
        // is the return value = 1? One row changed in the db
        if ($regOutcome === 1) {
            $message = "<p>Thank you for adding $categoryName. </p>";
            include '../view/add-category.php';
            exit;
        } else {
            $message = "<p>Sorry! $categoryName was not added. Please try again.</p>";
            include '../view/new-cat.php';
            exit;
        }
        break;
   case 'add-product':
//        echo 'You are hoping for the new product page'; 
//        exit;
        $invName = filter_input(INPUT_POST, 'invName');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invSize = filter_input(INPUT_POST, 'invSize');
        $invWeight = filter_input(INPUT_POST, 'invWeight');
        $invLocation = filter_input(INPUT_POST, 'invLocation');
        $invVendor = filter_input(INPUT_POST, 'invVendor');
        $invStyle = filter_input(INPUT_POST, 'invStyle');
               
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>All form fields are required. Please provide complete information for all form fields.</p>';
            include '../view/add-product.php';
            exit;
        }
        
        //call the function and send info to model
        $regOutcome = regCategory($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);
        //TODO: chg function to match product instead of register
                
        // is the return value = 1? One row changed in the db
        if ($regOutcome === 1) {
            $message = "<p>Thank you for adding $categoryName. </p>";
            include '../view/add-category.php';
            exit;
        } else {
            $message = "<p>Sorry! $categoryName was not added. Please try again.</p>";
            include '../view/new-cat.php';
            exit;
        }
        break;
    default:
        include '../view/prod-mgmt.php';
}