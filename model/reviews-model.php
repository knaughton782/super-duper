<?php
/*
 * REVIEWS MODEL
 */

//get basic review info for update/delete process
function getReviewInfo() {
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews ORDER BY reviewDate ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}
 
//  Insert a review
function addReview($reviewText, $reviewDate, $invId, $clientId) {
    $db = acmeConnect();
    $sql = 'insert into reviews (reviewText, reviewDate, invId, clientId ) values (:reviewText, :reviewDate, :invId, :clientId)';
    $stmt = $db->prepare($sql); // replace placeholders in sql statement with actual values in the variables and identifies data type for the db
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute(); //inserts the data or executes the query
    $rowsChanged = $stmt->rowCount(); //stores the number of rows changed in a variable so we can test for success
    $stmt->closeCursor(); //close db interaction

    return $rowsChanged; //shows success or failure of sql query
}

//*  Get reviews for a specific inventory item
function getReviewsByProduct($invId) {    //NEED A JOIN HERE
    $db = acmeConnect();
    $sql = 'SELECT *, clients.clientFirstname, clients.clientLastname FROM reviews join clients on reviews.clientId = clients.clientId where invId = :invId order by reviewDate desc';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $reviews;
}

//*  Get reviews written by a specific client
function getReviewsByUser($clientId) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.clientId = :clientId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $reviewsList;
}

//*  Get a specific review by reviewId
function getReviewById($reviewId) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $reviewInfo;
}

//    get & update specific review by id
function updateSpecificReview($reviewText, $reviewDate, $invId, $clientId) {
    $db = acmeConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate, invId = :invId, clientId = :iclientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}

//*  Delete a specific review
function deleteReview($reviewId) {
    //delete review by id
    $db = acmeConnect();
    $sql = 'DELETE FROM review WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}