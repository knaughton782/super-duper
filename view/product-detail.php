<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
  
    <h1 class="siteTitle"><?php echo $productInfo['invName'] ?> Details</h1>
    
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
         <section class="productDetails">
        <hr>
        <h2>Additional Product Thumbnails</h2>
        <?php
             if (isset($thumbnailDisplayVar)) {
                echo $thumbnailDisplayVar;
            }
        ?>
        
        
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
