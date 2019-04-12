<?php

/* 
 *  Accounts Model
 */

//to handle registrations
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{

    $db = acmeConnect();  //create db connection object

    $sql = 'Insert into clients (clientFirstname, clientLastname, clientEmail, clientPassword) values (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';  //the sql query

    $stmt = $db->prepare($sql); //create the prepared statement using the acme db connection

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    $stmt->execute(); //inserts the data
    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable
    $stmt->closeCursor(); //close db interaction
    return $rowsChanged;
}


//checks for duplicate email, 0 means no match, 1 means match
function checkExistingEmail($clientEmail)
{
    $db = acmeConnect();
    $sql = 'select clientEmail from clients where clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
        //        echo 'Nothing found';
        //        exit;
    } else {
        return 1;
        //        echo 'Match found';
        //        exit;
    }
}



// Get client data based on an email address
function getClient($clientEmail)
{

    $db = acmeConnect();

    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientEmail = :clientEmail';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);

    $stmt->execute();

    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $clientData;
}




// Get client data based on a client id
function getClientInfo($clientId)
{

    $db = acmeConnect();

    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword from clients where clientId = :clientId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    $stmt->execute();

    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $clientData;
}



//update client profile function
function updateClientInfo($clientFirstname, $clientLastname, $clientEmail, $clientId)
{

    $db = acmeConnect();

    $sql = 'Update clients set clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail where clientId = :clientId';

    $stmt = $db->prepare($sql); //prepared statement

    // replace placeholders in sql statement with actual values in the variables and identify data type for the db

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    $stmt->execute(); //inserts the data

    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable
    $stmt->closeCursor(); //close db interaction
    return $rowsChanged;
}



function updateClientPassword($clientPassword, $clientId)
{
    $db = acmeConnect();
    $sql = 'Update clients set clientPassword=:clientPassword where clientId = :clientId';
    $stmt = $db->prepare($sql); //prepared statement


    // replace placeholders in sql statement with actual values in the variables and identify data type for the db

    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute(); //inserts the data

    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable

    $stmt->closeCursor(); //close db interaction
    return $rowsChanged;
}