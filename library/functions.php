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
            
            $pd .= "<a href='/acme/products/?action=detail&invId=$product[invId]' title='View $product[invName]'>";
            
            $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
            
            $pd .= '</a>';
            
            $pd .= '<hr>';
            
            $pd .= "<a href='/acme/products/?action=detail&invId=$product[invId]' title='View $product[invName]'>";
            
            $pd .= "<h2>$product[invName]</h2>";
            
            $pd .= '</a>';
            
            $pd .= "<span>$product[invPrice]</span>";
            
            $pd .= '</li>';
            
        }
        
    $pd .= '</ul>';
    
    return $pd;
}


function buildProductDisplay($productInfo) {
    
    $details = '<ul id="displayDetails">';
    $details .= '<li>';
    $details .= "<img src='$productInfo[invImage]' alt='Image of our $productInfo[invName] product'>";
    $details .= '</li>';
    $details .= '<li id="description">';
    $details .= '<ul>';
    $details .= "<li id='detailsDescription'>$productInfo[invDescription]</li>";
    $details .= "<li id='detailsVendor'>$productInfo[invVendor] product</li>";
    $details .= "<li id='detailsStyle'>Primary Material: $productInfo[invStyle]</li>";
    $details .= "<li id='detailsWeight'>$productInfo[invWeight] lbs.</li>";
    $details .= "<li id='detailsSize'>Shipping size: $productInfo[invSize] inches (w x l x h)</li>";
    $details .= "<li id='detailsLocation'>Ships from $productInfo[invLocation]</li>";
    $details .= "<li id='detailsStock'>Number in stock: $productInfo[invStock]</li>";
    $details .= "<li id='detailsPrice'>$$productInfo[invPrice]</li>";
    $details .= '</ul>';
    $details .= '</li>';
    $details .= '</ul>';
    
    return $details;
    
}