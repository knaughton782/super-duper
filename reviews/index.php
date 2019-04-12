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
            $_SESSION['message'] = '<p class="warning">All fields are required.</p>';

            header('Location: /acme/products?action=detail&invId=' . $invId);
            exit;
        }

        // call the function and send info to model
        $reviewOutcome = addReview($reviewText, $reviewDate, $invId, $clientId);

        //is the return value = 1? One row changed in the db
        if ($reviewOutcome === 1) {

            header('Location: /acme/products?action=detail&invId=' . $invId);
            $_SESSION['message'] = "<p class='warning'>Your product review was successfully added! </p>";
            // echo print_r( $_SESSION['message'], TRUE );
            //exit;

            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Error! Your review was not added. Please try again.</p>";
            include '../view/product-detail.php';
            exit;
        }
        break;

    // deliver a view to edit a review
//    case 'editReview':
//        include '../view/review-update.php';
//        break;
    
    //gets the review to edit
    case 'editReview':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewInfo($reviewId);
        if (count($reviewInfo) < 1) {
            $_SESSION['message'] = '<p class="warning">Sorry, no reviews were found.</p>';
            header('Location: /acme/reviews/');
            exit;
        } 

        include '../view/review-update.php';
        exit;
        break;
    
    // handles the review update
    case 'updateReview':
               
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
        $clientId = $_SESSION['clientData']['clientId'];

        //check for empty form fields
        if (empty($reviewId) || empty($reviewText) || empty($reviewDate) || empty($invId) || empty($clientId)) {
            $_SESSION['message'] = '<p class="warning">All fields are required.</p>';

            header('Location: /acme/products?action=detail&invId=' . $invId);
            exit;
        }
        $updateReview = updateReview($reviewId, $reviewText, $reviewDate, $invId, $clientId);
        
        include '../view/review-update.php';
        break;



    case 'delRev':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $revInfo = getReviewById($reviewId);

        if (count($revInfo) < 1) {
            $_SESSION['message'] = '<p class="warning">Sorry, no review information could be found.</p>';
            header('Location: /acme/reviews/');
            exit;
        }
        include '../view/review-delete.php';
        exit;

        break;
        
    // delete review **************
    case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteReview($reviewId);

        if ($deleteResult) {
            $_SESSION['message'] = "<p class='instructions'>Congratulations, your review was successfully deleted.</p>";

            header('location: /acme/reviews/');
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Error: your review was not deleted.</p>";
            header('location: /acme/reviews/');
            exit;
        }
        break;


    // default delivers admin view if the client is logged in or the acme home view if not
    default:
        if ($_SESSION['loggedin']) {
            $clientId = $_SESSION['clientData']['clientId'];
            $reviews = getReviewsByUser($clientId);

            if (count($reviews) > 0) {
                $revList = reviewsDisplayOnAdmin($reviews);
            }
            else {
                $_SESSION['message'] = "<p class='warning'>No reviews found for this user.</p>";
            }
            include '../view/admin.php';
        }
        else {

            header('Location: /acme/');
            exit;
        }
        break;
}