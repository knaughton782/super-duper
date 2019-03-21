<?php

/*
 *  Helper functions file - NOT MODEL FUNCTIONS
 */

//to check for valide email
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for requirements
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}


// NAVLIST FUNCTION ************************

function navList($categories) {
    $navList = '<ul>';
    
    $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    
    foreach ($categories as $category) {
        
        $navList .= "<li><a href='/acme/products?action=category&categoryName=" . urlencode($category['categoryName']) . "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    
    $navList .= '</ul>';
    
    return $navList;
}


// products display function: uses <ul> ******************

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
        foreach ($products as $product) {
            $pd .= '<li>';
            $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
            $pd .= '<hr>';
            $pd .= "<h2>$product[invName]</h2>";
            $pd .= "<span>$product[invPrice]</span>";
            $pd .= '</li>';
        }
    $pd .= '</ul>';
    return $pd;
}