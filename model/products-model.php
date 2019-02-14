<?php

/* 
 *  Products Model
 */


// function to add new category to the acme categories table

function addCategory() {
    
    $db = acmeConnect();  //create db connection object
    
    $sql = 'insert into categories ( categoryName) values (:categoryName)'; //sql query
    
    $stmt = $db->prepare($sql); //prepared statement
    
    // replace placeholders in sql statement with actual values in the variables and identifies data type for the db
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    
    $stmt->execute(); //inserts the data or executes the query
    
    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable so we can test for success
    
    $stmt->closeCursor(); //close db interaction
    
    return $rowsChanged; //shows success or failure of sql query 
}


function addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle) {
    
    $db = acmeConnect();  //create db connection object
    
    $sql = 'insert into inventory ( invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle) values (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle, )'; //sql query
    
    $stmt = $db->prepare($sql); //prepared statement
    
    // replace placeholders in sql statement with actual values in the variables and identifies data type for the db
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    
    
    $stmt->execute(); //inserts the data or executes the query
    
    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable so we can test for success
    
    $stmt->closeCursor(); //close db interaction
    
    return $rowsChanged; //shows success or failure of sql query 
}