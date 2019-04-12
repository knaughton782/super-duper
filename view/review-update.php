<?php
if (!$_SESSION['loggedin']) {
    header('location: /acme/');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        // unset the message after displaying it once
        unset($_SESSION['message']);
    }
    ?>
    <section>
        <h1>Welcome <?php echo $username = $_SESSION['clientData']['clientFirstname']; ?></h1>
        <h2>Use this form to edit your review. All fields are required.</h2><br><br>

        <form action="/acme/reviews/" method="post">
            <fieldset>
                <label>Product Reviewed: </label>
                <input type="text" name="invName" id="invName" class="title" readonly value="<?php 
                if (isset($reviewInfo['invName'])) {
                    echo $reviewInfo['invName'];
                    
                }
                elseif (isset($invName)) {
                    echo $invName;
                    
                }
                ?>">
              
               
                
                <label>Review Date: </label>
                <input type="text" name="reviewDate" id="reviewDate" class="title" readonly value="<?php
                if (isset($reviewInfo['reviewDate'])) {
                    echo $reviewInfo['reviewDate'];
                }
                elseif (isset($reviewDate)) {
                    echo $reviewDate;
                }
                ?>">


                <label for="reviewText">Review Text: </label><br>
                <textarea name="reviewText" id="reviewText" required><?php
                    if (isset($reviewText)) {
                        echo $reviewText;
                    }
                    elseif (isset($reviewInfo['reviewText'])) {
                        echo $reviewInfo['reviewText'];
                    }
                    ?></textarea>


                <input type="submit" name="submit" class="updateReview" value="Update Review">
                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="invId" value="<?php
                if (isset($reviewInfo['invId'])) {
                    echo $reviewInfo['invId'];
                }
                elseif (isset($invId)) {
                    echo $invId;
                }
                ?>">
                <input type="hidden" name="reviewId" value="<?php
                if (isset($reviewInfo['reviewId'])) {
                    echo $reviewInfo['reviewId'];
                }
                elseif (isset($reviewId)) {
                    echo $reviewId;
                }
                ?>">
            </fieldset>
        </form>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>