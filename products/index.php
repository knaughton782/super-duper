<?php

/*
 *  Products controller ... direct user to add product or add category page and save info to the inventory or categories table in db
 */

//create or access a session
session_start();

#get db connection, helper functions, and bring models into scope

require_once '../library/connections.php'; 
require_once '../library/functions.php';
require_once '../model/acme-model.php'; 
require_once '../model/products-model.php'; 
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';


$categories = getCategories();
$navList = navList($categories);
$page_title = 'Inventory';


//watching for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}



switch ($action) {

    // deliver new category page 

    case 'newCat':
        include '../view/add-category.php';
        break;


// add new category logic // -----------------------------------------------------------


    case 'addCat':
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
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Error! $categoryName was not added. Please try again.</p>";
            include '../view/add-category.php';
            exit;
        }

        break;
        
// -----------------------------------------------------------

    case 'addProd': //delivers add product page

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

        if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $_SESSION['message'] = '<p class="warning">All form fields are required. Please provide complete information for all fields.</p>';
            include '../view/add-product.php';
            exit;
        }

        //call the function and send info to model
        $prodOutcome = addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);


        // is the return value = 1? One row changed in the db
        if ($prodOutcome === 1) {
            $_SESSION['message'] = "<p class='instructions'>Thank you for adding $invName! </p>";
            include '../view/prod-mgmt.php';
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Sorry! $invName was not added. Please try again.</p>";
            include '../view/add-product.php';
            exit;
        }

        break;

// -----------------------------------------------------------
    case 'newProd': //delivers add product page
        include '../view/add-product.php';
        break;


// -----------------------------------------------------------

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $_SESSION['message'] = '<p class="warning">Sorry, no product information could be found.</p>';
            header('Location: /acme/products/');
            exit;
        }

        if (isset($prodInfo['invName'])) {
            $page_title = "Modify $prodInfo[invName] ";
        }
        elseif (isset($invName)) {
            $page_title = $invName;
        }

        include '../view/prod-update.php';
        exit;
        break;

    


// Update Product // -----------------------------------------------------------


    case 'updateProd':
        
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);


        if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $_SESSION['message'] = '<p class="warning">Please complete all information fields including the category. </p>';

            include '../view/prod-update.php';
            exit;
        }

        $updateResult = updateProduct($invId, $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);

        if ($updateResult) {
            $message = "<p class='instructions'>Congratulations, $invName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Error. The product was not updated.</p>";
            include '../view/prod-update.php';
            exit;
        }

        break;


// -----------------------------------------------------------

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);

        if (count($prodInfo) < 1) {
            $_SESSION['message'] = '<p class="warning">Sorry, no product information could be found.</p>';
            header('Location: /acme/products/');
            exit;
        }
        include '../view/prod-delete.php';
        exit;

        break;


// -----------------------------------------------------------

    case 'deleteProd':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($invId);

        if ($deleteResult) {
            $message = "<p class='instructions'>Congratulations, $invName was successfully deleted.</p>";

            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        else {
            $message = "<p class='warning'>Error: $invName was not deleted.</p>";

            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;



// -----------------------------------------------------------

    case 'category':
        $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);

        $products = getProductsByCategory($categoryName);

        if (!count($products)) {
            $_SESSION['message'] = "<p class='warning'>Sorry, no $categoryName products could be found.</p>";
        }
        else {
            $prodDisplay = buildProductsDisplay($products);
        }

//        echo $prodDisplay;
//        exit;


        include '../view/category.php';

        break;

// -----------------------------------------------------------
//        display reviews will be on products controller
    case 'detail':
        
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        //$page_title = "$productInfo[invName]"; productInfo variable undefined
                
        // product info
        $productInfo = getProductInfo($invId);
        if (empty($productInfo)) {

            $_SESSION['message'] = "<p class='warning'>No product information could be found.</p>";
        }
        else {
            $prodDisplay = buildProductDisplay($productInfo);
        }

        // thumbnail info
        $thumbnails = getThumbnailImages($invId);
//           echo print_r( $thumbnails, TRUE );
//            exit;

        if ($thumbnails) {
            $thumbnailDisplayVar = thumbnailDisplay($thumbnails);
        }
        else {
            $_SESSION['message'] = '<p class="warning">Sorry, no additional thumbnail images have been uploaded for this product.</p>';
        }
        
        // review info
        $reviews = getReviewsByProduct($invId);      
//        echo print_r( $reviews, TRUE );
//        exit;
        
        if ($reviews) {
            $reviewDisplay = reviewsDisplay($reviews);
            $_SESSION['message'] = '<h2 class="warning">Product reviews are available at the bottom of the page.</h2>';
        }
        else {
            $_SESSION['message'] = '<p class="warning">No customer reviews have been added for this product.</p>';
        }

        include '../view/product-detail.php';
        break;



 // -----------------------------------------------------------
   
    default:

        $products = getProductBasics();
        if (count($products) > 0) {
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
        }
        else {
            $_SESSION['message'] = '<p class="warning">Sorry, no products were returned.</p>';
        }


        include '../view/prod-mgmt.php';
        break;
}
