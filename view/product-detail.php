<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
  
    <h1 class="siteTitle"><?php echo $productInfo['invName'] ?> Details</h1>
    <h2>Product reviews are available at the bottom of the page.</h2>
    
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];

                unset ($_SESSION['message']);
            }
        ?>


    <section class="productDetails">
        
        <?php
             if (isset($prodDisplay)) {
                echo $prodDisplay;
            }
        ?>
        <br>
    </section>
    
    <h3>Product Thumbnails</h3>
    <section class="thumbnails">

        
        <?php
             if (isset($thumbnailDisplayVar)) {
                echo $thumbnailDisplayVar;
            }
        ?>
        
    </section>
    
    <h3>Customer Reviews</h3>
    <section class="reviews">
        
        <!-- ------- show form if they are logged in ------ -->
  
        <?php if ($_SESSION['loggedin']) {?>
            <p class="border"></p>
                       
            <h3>Add a product review:</h3>
            
            <form action="/acme/reviews/" method="post">
                <fieldset>
                    
                    <label for='clientId'>Review by:<br></label><br>
                    <input type="text" name="clientId" id="clientId" readonly><br>
                    
                    <label for="reviewText">Write review here:</label><br>
                    <textarea name="reviewText" id="reviewText" <?php if (isset($reviewText)) {
                        echo $reviewText; } ?> required></textarea>

                    <input type="submit" name='submit' class="reviewBtn" value="Add Review">
                    
                    <input type="hidden" name="action" value="add_review">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    <input type="hidden" name="invId" value="<?php echo $_SESSION['clientData']['invId']; ?>">
                    
                </fieldset>
            </form>       
           <?php } ?>
            
            <!-- ----------- if not logged in ----------- --> 
            
            <?php if (!$_SESSION['loggedin']) { ?>
            
               <!--provide a link to the login page-->
                <section>
                    <h3>Want to review a product?</h3> <br>
                    <a href="/acme/index.php?action=login" title="Click to login to review a product" id="registrationLink">Please log in</a>
           
                </section>
             
          <?php   }  ?>
           

        
        
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
