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


//watch for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

//$_SESSION['loggedin'] = TRUE;

//only add, update, and delete review, not display admin view for reviews


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
            header('Location: /acme/products?action=detail&invId=' . $invId); 
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Error! Your review was not added. Please try again.</p>";
            
            include '../view/product_detail.php';
            exit;
        }
        break;
        
        
// edit review ****************
    
    case 'deliverModifyReview':

        include '../view/accounts/';

        break;

    
    case 'modifyReview':
        
        if ($reviews) {
            $modifyReviews = personalReviewsTable($reviews);
            $_SESSION['message'] = '<h2 class="warning">Modify your reviews at the bottom of the page.</h2>';
        }
        else {
            $_SESSION['message'] = '<p class="warning">No product reviews have been found for your account.</p>';
        }
        
        include '';
        break;

    // delete review **************
   case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($invId);

        if ($deleteResult) {
            $message = "<p class='instructions'>Congratulations, $reviewId was successfully deleted.</p>";

            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        else {
            $message = "<p class='warning'>Error: $reviewId was not deleted.</p>";

            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;

    
// default delivers admin view if the client is logged in or the acme home view if not

    default:
        if ($_SESSION['loggedin']) {
            include '../view/admin.php';
        }
        
        else {
            
            header('Location: /acme/');
            exit;
        }
        break;
}
