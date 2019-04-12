<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
  
    <h1 class="siteTitle"><?php echo $productInfo['invName'] ?> Details</h1>
        
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset ($_SESSION['message']);
            } ?>

    <section class="productDetails">
        
        <?php
             if (isset($prodDisplay)) {
                echo $prodDisplay;
            } ?>
        <br>
    </section>
    
    <h2><?php echo $productInfo['invName'] ?> Thumbnails</h2>
    <section class="thumbnails">
        
        <?php
             if (isset($thumbnailDisplayVar)) {
                echo $thumbnailDisplayVar;
            } ?>
        
    </section>
       
    <section class="reviews">
        
        <!-- show form if they are logged in ********************* -->
  
        <?php if (isset ($_SESSION['loggedin'])) {?>
        
         <h2><?php echo $productInfo['invName'] ?> Reviews</h2>
            <p class="border"></p>
                       
            <h3>Add a <?php echo $productInfo['invName'] ?> review:</h3>
            
            <form action="/acme/reviews/" method="post">
                <fieldset>
                    
                    <label>Review by: </label>
                    <span class="title"><?php echo $username = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname']; ?></span>
                    <br><br>
                    
                    <label for="reviewText">Write review here:</label><br>
                    <textarea name="reviewText" id="reviewText" <?php if (isset($reviewText)) { echo $reviewText; } ?> required></textarea>

                    <input type="submit" name='submit' class="reviewBtn" value="Add Review">
                    
                    <input type="hidden" name="action" value="add_review">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    <input type="hidden" name="invId" value="<?php echo $productInfo['invId']; ?>">
                    
                </fieldset>
            </form>    
    </section>
        <?php } 
             else { ?>
            
               <!--provide a link to the login page-->
                <section>
                    <h3>Want to review a product?</h3> <br>
                    <a href="/acme/index.php?action=login" title="Click to login to review a product" id="registrationLink">Please log in</a>
           
                </section>  <?php   }  ?>
               
                <section class="reviewBox">
                
                        <?php
                            if (isset($reviewDisplay)) {
                                   echo $reviewDisplay;
                               } ?>
            
                </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
