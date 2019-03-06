<?php

/*
 * ACCOUNTS controller (direct the user to a page and save info to db)
 */
//create or access a session
session_start();


require_once '../library/connections.php'; //get db connection 
require_once '../model/acme-model.php'; //get model
require_once '../model/accounts-model.php'; //brings accounts-model into scope
require_once '../library/functions.php'; //get helper functions

$categories = getCategories();
$navList = navList($categories);

// watch for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;

    case 'login_user':
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
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error and return to the login view
        if (!$hashCheck) {
             $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array with the array_pop function
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
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

        //check for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        if ($existingEmail) {
             $message = '<p>That email address already exists. Please log in.</p>';
            include '../view/login.php';
            exit;
        }
        

        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
             $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        //call the function and send info to model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // is the return value = 1? One row changed in the db
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /acme/accounts/?action=login');
            exit;
        } else {
             $message = "<p>Sorry $clientFirstname, but your registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
        
    case 'logout':
        session_destroy();
        header('Location: /acme/');
        break;

    default:
        include '../view/admin.php';
        break;
}

