<?php
if (!$_SESSION['loggedin']){
    header('location: /acme/');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content">
    <section>
        <h1>Welcome <?php echo $username = $_SESSION['clientData']['clientFirstname']; ?></h1>
        <h2>Use this form to update your review. All fields are required.</h2><br><br>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            // unset the message after displaying it once
            unset($_SESSION['message']);
        }
        ?>
        <form action="/acme/reviews/" method="post">
            <fieldset>
                <label>Review by: </label>
                <input name="clientFirstname" id="clientFirstname" class="title" readonly <?php if(isset($clientFirstname)){ echo "value = '$clientFirstname'"; ?> > <br>
                
                
                <label>Review Date: </label>
                <input name="reviewDate" id="reviewDate" class="title" readonly <?php if(isset($reviewDate)){ echo "value = '$reviewDate'"; ?> > <br> 
                    
                                                
                <label for="reviewText">Review Text: </label><br>
                <textarea name="reviewText" id="reviewText" required><?php
                    if (isset($reviewText)) { 
                        echo $reviewText; 
                    } 
                    elseif (isset($reviews['reviewText'])) {
                        echo $reviews['reviewText'];
                        } 
                    ?></textarea><br>


                <input type="submit" name="submit" class="updateReview" value="Update Review">

                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="reviewId" value="<?php if (isset($reviews[reviewId])) {
                        echo $reviews[reviewId]; }?>">
            </fieldset>
        </form>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>