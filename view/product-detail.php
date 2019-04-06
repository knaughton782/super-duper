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
                       
            <h1>Add a product review:</h1>
            
<!--                <form action="" method="post">
                    <fieldset>
                        <label for="reviewText">Write review here:</label><br>
                        <input type="" name="" id="" //<?php if (isset()) {
//                            echo "value'$variablehere'";
                    //} ?> required><br>

                        <label for='clientPassword'>Password:<br>
                        <span class="warning">Passwords must be at least 8 characters. Please include at least 1 number, 1 capital, and 1 special character.</span>
                        </label><br>

                        <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

                        <input type="submit" name='submit' class="loginBtn" value="Login">
                        <input type="hidden" name="action" value="login_user">
                    </fieldset>
            </form>-->
            
           <?php }
        ?>
            
            <!-- ----------- if not logged in ----------- --> 
            
            <?php if (!$_SESSION['loggedin']) {
            
//                provide a link to the login page
             
             }
            ?>

        
        
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
