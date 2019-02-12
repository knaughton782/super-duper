<?php

/*
 * accounts controller ....... should direct the user to a page and save something to the clients table in db
 */
require_once '../library/connections.php'; //get db connection 
require_once '../model/acme-model.php'; //get model
require_once '../model/accounts-model.php'; //brings accounts-model into scope

//get array of categories
$categories = getCategories();

//dynamic navigation
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/index.php?action=" . urlencode($category['categoryName']) . "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'register':
//        echo 'You are hoping for the registration page'; 
//        exit;
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');
        
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
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

