<?php

/*
 * accounts controller ... direct the user to a page and save info to clients table in db
 */
require_once '../library/connections.php'; //get db connection 
require_once '../model/acme-model.php'; //get model
require_once '../model/accounts-model.php'; //brings accounts-model into scope
require_once '../library/functions.php'; //get helper functions

//get array of categories
$categories = getCategories();

//dynamic navigation
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/index.php?action=" . urlencode($category['categoryName']) . "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

// watch for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;
    
    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        
         //validate email
        $clientEmail = checkEmail($clientEmail);
        //check password
        $checkPassword = checkPassword($clientPassword);
        
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }
        break;
    
    case 'register':
//        echo 'You are hoping for the registration page'; 
//        exit;
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        
        //validate email
        $clientEmail = checkEmail($clientEmail);
        //check password
        $checkPassword = checkPassword($clientPassword);
        
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        
        //call the function and send info to model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
        
        // is the return value = 1? One row changed in the db
        if ($regOutcome === 1) {
            $message = "<p>Thank you for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but your registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
   
    default:
        include '../view/login.php';
}

