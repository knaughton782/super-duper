<?php

/*
 *  Products Model - all db functionality exists in the model
 */

// function to add new category to the acme categories table
function addCategory($categoryName) {

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

//product function *****************

function addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle) {

    $db = acmeConnect();  //create db connection object
    $sql = 'insert into inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId,  invVendor, invStyle) values ( :invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)'; //sql query
    $stmt = $db->prepare($sql); //prepared statement
    // replace placeholders in sql statement with actual values in the variables and identifies data type for the db
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR); //no float option so use str
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);

    $stmt->execute(); //inserts the data or executes the query
    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable so we can test for success
    $stmt->closeCursor(); //close db interaction
    return $rowsChanged; //shows success or failure of sql query 
}

//this function will get basic product ifo from the inventory for the update/delete process
function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}

// Get product information by invId ********************

function getProductInfo($invId){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $prodInfo;
}

// Update a product ********************

function updateProduct($invId, $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle) {
        // Create a connection
        $db = acmeConnect();
        
        // The SQL statement to be used with the database
        $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
        
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
        $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
        $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
        $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
        $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
       
        
        
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $rowsChanged;
}

function deleteProduct($invId) {
        $db = acmeConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
}


// funtion to get a list of products based on the category

function getProductsByCategory($categoryName) {
    
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
    
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    
    $stmt->execute();
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt->closeCursor();
    return $products;
    
}