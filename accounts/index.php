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
$page_title = 'Accounts';

// watch for name/value pairs
$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    
        

switch ($action) {
    
///////////////////////////// login case /////////////////////    
    case 'login':
        include '../view/login.php';
        break;
    
    
///////////////////////////// login user case /////////////////////   

    case 'login_user':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        //validate email
        $clientEmail = checkEmail($clientEmail);
        //check password
        $checkPassword = checkPassword($clientPassword);

        if (empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p class="warning">Please provide information for all empty form fields.</p>';
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
            $_SESSION['message'] = '<p class="warning">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array with the array_pop function
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        
        
        // Send them to the admin view if login is successful
        include '../view/admin.php';
        break;
        
        
//////////////////////// Register case /////////////////////////       

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
             $_SESSION['message'] = '<p class="warning">That email address already exists. Please log in.</p>';
            include '../view/login.php';
            exit;
        }
        

        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
             $_SESSION['message'] = '<p class="warning">Please provide information for all empty form fields.</p>';
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
            $_SESSION['message'] = "<p class='instructions'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /acme/accounts/?action=login');
            exit;
        } 
        else {
            $_SESSION['message'] = "<p class='warning'>Sorry $clientFirstname, but your registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
        
        
////////////////////// DELIVER UPDATE PAGE ///////////////////////////////     
    
    case 'update':
        include '../view/client-update.php';
        break;
    
    
///////////////////// UPDATE PROFILE INFORMATION ///////////////////////////////     
    
    case 'update_user':
 
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        
         
        
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                 $_SESSION['message'] = '<p class="warning">Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }
        //validate email
        $clientEmail = checkEmail($clientEmail);    
        
        $updateResult = updateProfile($clientFirstname, $clientLastname, $clientEmail, $clientId);
            
            if ($updateResult) {
                $_SESSION['message'] = "<p class='instructions'>Congratulations, $clientFirstname, your profile was updated successfully.";
                $clientData = getClientInfo($clientId);
                
                $_SESSION['clientData'] = $clientData;

                include '../view/admin.php';
                exit;
            }
            else {
                $_SESSION['message'] = "<p class='warning'>Sorry,your profile was not updated. Please try again.";
                include '../view/client-update.php';
                exit;
            }
                
        
        // Send them to the admin view if update is successful
        include '../view/admin.php';
        break;
        
///////////////////// UPDATE Password /////////////////////////////// 
    case 'update_pw':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
        $checkPassword = checkPassword($clientPassword);
        if (empty($checkPassword)) {
            $_SESSION['message'] = '<p class="warning">Please make sure your password matches the required pattern.</p>';
            include '../view/client-update.php';
            exit;
        }
        
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $updateResult = updatePassword($clientId, $hashedPassword);
        
        if ($updateResult) {
            $_SESSION['message'] = '<p class="instructions">Congratulations, your password has been updated.</p>';
            include '../view/admin.php';
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Your password was not updated. Please try again.</p>";
            include '../view/admin.php';
        }
        
        break;
        
//////////////////// logout ///////////////////////////////        
        
    case 'logout':
        session_destroy();
        header('Location: /acme/');
        break;
    
    
/////////////////////// DEFAULT ///////////////////////////////     

    default:
        include '../view/admin.php';
        break;
}

