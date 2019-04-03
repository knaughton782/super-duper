<?php

/*
 * REVIEWS CONTROLLER :
 */

session_start();

require_once '../library/connections.php'; //get db connection (must be first)
require_once '../library/functions.php'; //get helper functions
require_once '../model/acme-model.php'; //get model (gets info from db)
require_once '../model/products-model.php'; //get model (gets info from db)
require_once '../model/uploads-model.php'; //get uploads model (gets info from db)
require_once '../model/reviews-model.php'; //get reviews model (gets info from db)

$categories = getCategories();
$navList = navList($categories);
$page_title = 'Reviews';


//watching for name/value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {


    // add a new review **************
    case '':

        include '';

        break;

    // Deliver a view to edit a review **************
    case '':

        include '';

        break;

    // Handle the review update **************
    case '':

        include '';

        break;

    // Deliver a view to confirm deletion of a review **************
    case '':

        include '';

        break;

    // Handle the review deletion **************
    case '':

        include '';

        break;

    // default that will deliver the "admin" view if the client is logged in or the acme home view if not

    default:

        include '';
        break;
}