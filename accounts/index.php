<?php

/*
 * ACCOUNTS controller: directs user to specific pages and saves user info to db)
 */

session_start();

#get db connection, helper functions, and bring models into scope

require_once '../library/connections.php'; 
require_once '../model/acme-model.php'; 
require_once '../model/accounts-model.php'; 
require_once '../library/functions.php'; 

$categories = getCategories();
$navList = navList($categories);
$page_title = 'Accounts';

// watch for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {

# login case ***********************
    case 'login':
        $page_title = 'Login';
        include '../view/login.php';
        break;


# login user case ***********************

    case 'login_user':
        
        if(isset($_COOKIE['firstname'])) {
            unset($_COOKIE['firstname']);
            setcookie('firstname', '', strtotime('now'), '/');
        }
        
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        
        $clientEmail = checkEmail($clientEmail); //validate email
        
        $checkPassword = checkPassword($clientPassword); //check password

        if (empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p class="warning">Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }
        
        # A valid password exists, proceed with the login process
        # Query the client data based on the email address
        $clientData = getClient($clientEmail);
        
        # Compare the password just submitted against the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        
        # If the hashes don't match create an error and return to the login view
        if (!$hashCheck) {
            $_SESSION['message'] = '<p class="warning">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        
        $_SESSION['loggedin'] = TRUE; // A valid user exists, log them in
  
        array_pop($clientData);       // Remove the password from the array with the array_pop function
        
        $_SESSION['clientData'] = $clientData; // Store the array into the session

      

        // Send them to the admin view if login is successful
        include '../view/admin.php';
        break;


# register case ***********************

    case 'register':
//        echo 'You are hoping for the registration page';
//        exit;
        $page_title = 'Registration';

        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        
        $checkPassword = checkPassword($clientPassword);

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

        # One row changed in the db 
        if ($regOutcome === 1) { 
           
            setcookie('firstname', $cookieFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p class='instructions'>$clientFirstname, thanks for creating an account. Please use your email and password to login.</p>";

            header('Location: /acme/accounts/?action=login');
            exit;
        }
        
        else {
            $_SESSION['message'] = "<p class='warning'>Sorry $clientFirstname, but registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        
        break;


// deliver update page ***********************

    case 'updateClient':
        $page_title = 'Update Profile';
        include '../view/client-update.php';
        break;


// update profile information ***********************

    case 'updateClientInfo':

        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);


        $clientEmail = checkEmail($clientEmail); # validate


        //check for different email in session
        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {

            $existingEmail = checkExistingEmail($clientEmail);

            if ($existingEmail) {
                $_SESSION['message'] = '<p class="warning">That email address already exists. Please log in.</p>';
                include '../view/client-update.php';
                exit;
            }
        }


        //make sure all fields have info
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = '<p class="warning">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }


        $updateOutcome = updateClientInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);

        if ($updateOutcome === 1) {
            $clientInfo = getClientInfo($clientId);

            $_SESSION['clientData'] = $clientInfo;

            $_SESSION['message'] = "<p class='instructions'>Congratulations $clientFirstname! Your profile was updated successfully.";

            include '../view/client-update.php';
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>***Sorry, your profile was not updated. Please try again.";
            include '../view/client-update.php';
            exit;
        }


        break;

// update password ***********************
    case 'updateClientPassword':

        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $checkPassword = checkPassword($clientPassword);


        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        if (empty($clientPassword)) {
            $_SESSION['message'] = '<p class="warning">Please check password requirements and try again.</p>';
            include '../view/client-update.php';
            exit;
        }

        $updateOutcome = updateClientPassword($hashedPassword, $clientId);

        if ($updateOutcome) {
            $_SESSION['message'] = '<p class="instructions">Congratulations, your password has been updated.</p>';
            header('location: ../view/admin.php');
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='warning'>Your password was not updated. Please try again.</p>";
            include '../view/client-update.php';
        }

        break;
        

// logout ***********************
    case 'logout':

        session_destroy();
        header('Location: /acme/');
        break;


// DEFAULT **************************************

    default:
        include '../view/admin.php';
        break;
}

