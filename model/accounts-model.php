<?php

/* 
 *  Accounts Model
 */

//to handle registrations
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
        
    $db = acmeConnect();  //create db connection object
    
    $sql = 'Insert into clients (clientFirstname, clientLastname, clientEmail, clientPassword) values (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';  //the sql query
    
    $stmt = $db->prepare($sql); //create the prepared statement using the acme db connection
    
     // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    
    $stmt->execute(); //inserts the data
    
    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable
    
    $stmt->closeCursor(); //close db interaction
    
    return $rowsChanged; //shows a successful function execution and provides a variable with data to work with
}

