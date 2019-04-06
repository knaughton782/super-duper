<?php

/*
 * REVIEWS CONTROLLER :
 */

session_start();

# get db connection, helper functions, bring models into scope
require_once '../library/connections.php'; 
require_once '../library/functions.php'; 
require_once '../model/acme-model.php'; 
require_once '../model/products-model.php'; 
require_once '../model/uploads-model.php'; 
require_once '../model/reviews-model.php'; 

$categories = getCategories();
$navList = navList($categories);
$page_title = 'Reviews';


//watchß for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

$_SESSION['loggedin'] = TRUE;

switch ($action) {


    // insert a review **************
    case 'add_review':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        //check for empty form fields
        if (empty($reviewText)) {
            $_SESSION['message'] = '<p class="warning">All fields are required. Please provide complete information.</p>';
            
            include '../view/product_detail.php';
            exit;
        }
        
        // call the function and send info to model
        $reviewOutcome = addReview($reviewText, $reviewDate, $invId, $clientId);

        //is the return value = 1? One row changed in the db
        if ($reviewOutcome === 1) {
            header('Location: /acme/products/');
            exit;
        }
        
        else {
            $_SESSION['message'] = "<p class='warning'>Error! Your review was not added. Please try again.</p>";
            
            include '../view/product_detail.php';
            exit;
        }

        break;
        
        

    // Deliver a view to edit a review **************
    case '':

        include '';

        break;

    // Handle the review update **************
    case '':

        include '';

        break;

    // Deliver a view to confirm deletion of a review **************
    case '':

        include '';

        break;

    // delete review **************
    case '':

        include '';

        break;

    // default that will deliver the "admin" view if the client is logged in or the acme home view if not

    default:

        include '';
        break;
}