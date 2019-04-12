<?php

/* 
 * This is the Acme Model (models interact with the db)
 */

function getCategories()
{
    $db = acmeConnect(); //creates the connection object

    $sql = 'SELECT categoryName, categoryId FROM categories ORDER BY categoryName ASC'; //the query

    $stmt = $db->prepare($sql); //create the prepared statement

    $stmt->execute(); //run the prepared statement

    $categories = $stmt->fetchAll(); //gets data from db and stores it in $categories array

    $stmt->closeCursor(); //close db connection

    return $categories; //return statement sends array back to the function call (controller)
}