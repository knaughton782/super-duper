<?php if (!$_SESSION['loggedin']) {
    header('location: /acme/');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
  
    <h1 class="siteTitle">You are logged in, <?php echo $_SESSION['clientData']['clientFirstname']; ?></h1>

    
    <section>
        <ul>
            <li>First name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
            <li>Last name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            <li>Client Level: <?php echo $_SESSION['clientData']['clientLevel']; ?></li>
        </ul>
        
    </section>
        <?php 
                if($_SESSION['clientData']['clientLevel'] > 1) {
            ?>
           <p><a href="/acme/products/" title="Go to products page">Manage Products</a></p>
           <?php
                }
        ?>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
