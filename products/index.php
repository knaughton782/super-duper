<?php

/*
 *  Products controller ... direct user to add product or add category page and save info to the inventory or categories table in db
 */

//create or access a session
session_start();


require_once '../library/connections.php'; //get db connection (must be first)
require_once '../library/functions.php'; //get helper functions
require_once '../model/acme-model.php'; //get model (gets info from db)
require_once '../model/products-model.php'; //get model (gets info from db)


$categories = getCategories();
$navList = navList($categories);

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
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

        //check for empty form fields
        if (empty($categoryName)) {
            $_SESSION['message'] = '<p class="warning">All fields are required. Please provide complete information.</p>';
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
            $_SESSION['message'] = "<p>Error! $categoryName was not added. Please try again.</p>";
            include '../view/add-category.php';
            exit;
        }
        break;

    case 'newProd': //delivers add product page
        
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT); 
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

        if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) ||  empty($invVendor) || empty($invStyle)) {
             $_SESSION['message'] = '<p>All form fields are required. Please provide complete information for all form fields.</p>';
            include '../view/add-product.php';
            exit;
        }

        //call the function and send info to model
        $prodOutcome = addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);


        // is the return value = 1? One row changed in the db
        if ($prodOutcome === 1) {
             $_SESSION['message'] = "<p>Thank you for adding $invName! </p>";
            include '../view/add-product.php';
            exit;
        } else {
             $_SESSION['message'] = '<p class="warning">Sorry! $invName was not added. Please try again.</p>';
            include '../view/add-product.php';
            exit;
        }
        break;

    case 'addProd': //delivers add product page
        include '../view/add-product.php';
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
                $_SESSION['message'] = 'Sorry, no product information could be found.';
                header('Location: /acme/products/');
                exit;
        }
        include '../view/prod-update.php';
        exit;
        break;
    
    
    
    
    default:
        
        $products = getProductBasics();
        if(count($products) > 0){
                $prodList = '<table>';
                $prodList .= '<thead>';
                $prodList .= '<tr><th>Product Name</th><th>&nbsp;</th><th>&nbsp;</th></tr>';
                $prodList .= '</thead>';
                $prodList .= '<tbody>';
                
                    foreach ($products as $product) {
                        $prodList .= "<tr><td>$product[invName]</td>";
                        $prodList .= "<td><a href='/acme/products?action=mod&invId=$product[invId]' title='Click to modify'>Modify</a></td>";
                        $prodList .= "<td><a href='/acme/products?action=del&invId=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
                       }
                $prodList .= '</tbody></table>';
                   } else {
                    $_SESSION['message'] = '<p class="notify">Sorry, no products were returned.</p>';
                }
        
        
        include '../view/prod-mgmt.php';
        break;
}
