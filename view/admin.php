<?php if (!$_SESSION['loggedin']) {
     header('location: /acme/accounts?action=login');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
  
    <h1 class="siteTitle">Welcome <?php echo $_SESSION['clientData']['clientFirstname']; ?></h1>
    <h3>You are successfully logged in.</h3>
    <?php  if (isset($_SESSION['message'])) {
                    echo  $_SESSION['message'];
                    
                    unset($_SESSION['message']);
    } ?>
    
    <section>
        <ul>
            <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
            <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            
        </ul>
    </section>
    
    <p><a href="/acme/accounts?action=updateClient" title="Click to Manage Your Account" id="acctMgmtLink">Click to Manage Your Account</a><br><br>
        <p class="border"></p> 
        
        
        
    <h1>Manage your reviews: </h1>
        <?php // if () {
            //echo message if there are review or only show the review section if there are reviews
        //} ?>
    <?php if (isset($personalReviewsTable)) {
            echo $personalReviewsTable;
        } ?>
    <p class='border bottom-space'></p>
   
<!-- ------- This should only be seen by admin levels ------ -->
  
        <?php if ($_SESSION['loggedin'] && $_SESSION['clientData']['clientLevel'] > 1) {?>
            <p class="border"></p>       
            <h1>Products Administration:</h1>            
            <p>Use the link below to manage Acme products.</p><br><br>

            <p><a href="/acme/products/" id="mgProd" title="Go to products page">Manage Products</a></p>
            
           <?php }
        ?>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
