<?php
/*
 *  Helper functions file - NOT MODEL FUNCTIONS
 */

//to check for valid email
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for requirements
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function navList($categories){
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

function buildProductDisplay($productInfo){

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

function reviewsDisplayOnProduct($reviews){

    $reviewList = '<h3>Previous Reviews</h3>';
    $reviewList .= '<ul>';

    foreach ($reviews as $review) {
        $username = substr($review['clientFirstname'], 0, 1) . $review['clientLastname'];
        $date = date('M d, Y', strtotime($review['reviewDate']));

        $reviewList .= '<li>';
        $reviewList .= "<span class='title'>Written by: $username on $date</span>";
        $reviewList .= "<span class='text'>$review[reviewText]</span>";
        $reviewList .= '</li>';
    }

    $reviewList .= '</ul>';

    return $reviewList;
}

function reviewsDisplayOnAdmin($reviews){

    $revList = '<table>';
    $revList .= '<thead>';
    $revList .= '<tr><th>Date Reviewed:</th><th>Your reviews:</th><th>&nbsp;</th><th>&nbsp;</th></tr>';
    $revList .= '</thead>';
    $revList .= '<tbody>';

        foreach ($reviews as $review) {
            $date = date('M d, Y', strtotime($review['reviewDate']));

            $revList .= "<tr><td>$date</td>";
            $revList .= "<td>$review[reviewText]</td>";
            $revList .= "<td><a href='/acme/reviews?action=editReview&reviewId=$review[reviewId]' title='Click to modify'>Modify</a></td>";
            $revList .= "<td><a href='/acme/reviews?action=deleteReview&reviewId=$review[reviewId]'
                        title='Click to delete'>Delete</a></td></tr>";
            }
        $revList .= '</tbody></table>';
        
        return $revList;
}


/* * *********** IMAGE FUNCTIONS ***************** */

// Adds "-tn" designation to file name
function makeThumbnailName($image){

    $i = strrpos($image, '.');

    $image_name = substr($image, 0, $i);

    $ext = substr($image, $i);

    $image = $image_name . '-tn' . $ext;

    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray){
    $id = '<ul id="image-display">';

    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';

    return $id;
}

//display thumbnails
function thumbnailDisplay($thumbnails){
    //print_r($thumbnails[0]);
    $thumbnailTable = '<table>';
    $thumbnailTable .= '<tr>';

    foreach ($thumbnails as $thumbnail) {
        $name = $thumbnail['imgName'];
        $path = $thumbnail['imgPath'];

        $thumbnailTable .= '<td>';
        $thumbnailTable .= "<img src='$path' title='$name image on Acme.com' alt='$name image on Acme.com'>";
        $thumbnailTable .= '</td>';
    }
    $thumbnailTable .= '</tr>';
    $thumbnailTable .= '</table>';
    return $thumbnailTable;
}

// Build the products select list
function buildProductsSelect($products){
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";

    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';

    return $prodList;
}

/* This file stores the physical file to the server and returns the path of where the file was stored. That path will then be inserted to the database. */
function uploadFile($name){
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;

    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];

        if (empty($filename)) {
            return;
        }

        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];

        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;

        // Moves the file to the target folder
        move_uploaded_file($source, $target);

        // Send file for further processing
        processImage($image_dir_path, $filename);

        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;

        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and creating smaller versions of the image
function processImage($dir, $filename){
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height){
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {

        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;

        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;

        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;

        default:
            return;
    } // ends the resizeImage function
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
}   // ends the if - else

//end image functions *******************************************


















// Admin user:
// Firstname: Admin
// Lastname: User
// Email: admin@cit336.net
// Password: Sup3rU$er



// non-Admin user:
// Firstname: Kirsten
// Lastname: Naughton
// Email: kirsten.naughton@gmail.com
// Password: Password1!


// print_r($_SESSION['clientData']);
// exit;

// echo '<pre' . print_r($reviews, true) . '<pre>';
//exit;