<?php

/*
 *  Products controller ... direct user to add product or add category page and save info to the inventory or categories table in db
 */
require_once '../library/connections.php'; //get db connection (must be first)
require_once '../model/acme-model.php'; //get model (gets info from db)
require_once '../model/products-model.php'; //get model (gets info from db)

$categories = getCategories();

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
$catList .= '<option>Select an option: </option>';
foreach ($categories as $category) {
    $catList .= '<option value=" ' . $category['categoryId'] . ' ">' . $category['categoryName'] . '</option>';
}
$catList .= '</select>';
//echo $catList;     // for testing
//exit;


//watching for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'newCat': //delivers add category page
        include '../view/add-category.php';
        break;
    
    case 'addCat': //processes new category logic
          $categoryName = filter_input(INPUT_POST, 'categoryName');
       
        //check for empty form fields
        if (empty($categoryName)) {
            $message = '<p class="warning">All fields are required. Please provide complete information.</p>';
            include '../view/add-category.php';
            exit;
        }
       // call the function and send info to model
        $catOutcome = addCategory($categoryName);
        
         //is the return value = 1? One row changed in the db
        if ($catOutcome === 1) {
           header('Location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error! $categoryName was not added. Please try again.</p>";
            include '../view/add-category.php';
            exit;
        }
        break;

    
    default:
        include '../view/product-management.php';
}

//switch ($action) {
//        //process category request
//     case 'addCat':
////        echo 'You are hoping for the new category page'; 
////        exit;
//        $categoryName = filter_input(INPUT_POST, 'categoryName');
//               
//        if (empty($categoryName)) {
//            $message = '<p>All fields are required. Please provide complete information.</p>';
//            include '../view/add-category.php';
//            exit;
//        }
//        
//        //call the function and send info to model
//        $catOutcome = addCategory($categoryName);
//                      
//        // is the return value = 1? One row changed in the db
//        if ($catOutcome === 1) {
//            $message = "<p>Thank you for adding $categoryName. </p>";
//            include '../products/index.php';
//            exit;
//        } else {
//            $message = "<p>Error! $categoryName was not added. Please try again.</p>";
//            include '../view/add-category.php';
//            exit;
//        }
//        break;
//        
//        
//        //process products request
//   case 'addProd':
////        echo 'You are hoping for the new product page'; 
////        exit;
//        $invName = filter_input(INPUT_POST, 'invName');
//        $invDescription = filter_input(INPUT_POST, 'invDescription');
//        $invImage = filter_input(INPUT_POST, 'invImage');
//        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
//        $invPrice = filter_input(INPUT_POST, 'invPrice');
//        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT); //validate is looking for an integer here 
////FILTER_SANITIZE_NUMBER_INT
//        $invSize = filter_input(INPUT_POST, 'invSize');
//        $invWeight = filter_input(INPUT_POST, 'invWeight');
//        $invLocation = filter_input(INPUT_POST, 'invLocation');
//        $categoryId = filter_input(INPUT_POST, 'categoryId');
//        $invVendor = filter_input(INPUT_POST, 'invVendor');
//        $invStyle = filter_input(INPUT_POST, 'invStyle');
//               
//        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
//            $message = '<p>All form fields are required. Please provide complete information for all form fields.</p>';
//            include '../view/add-product.php';
//            exit;
//        }
//        
//        //call the function and send info to model
//        $prodOutcome = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
//        
//                
//        // is the return value = 1? One row changed in the db
//        if ($prodOutcome === 1) {
//            $message = "<p>Thank you for adding $invName! </p>";
//            include '../view/add-product.php';
//            exit;
//        } else {
//            $message = "<p>Sorry! $invName was not added. Please try again.</p>";
//            include '../view/add-product.php';
//            exit;
//        }
//        break;
//     case 'prodMgmt':
//          include '../view/product-management.php';
//         break;
//    default:
//        include '../view/product-management.php';
//}