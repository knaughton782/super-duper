<?php if (!$_SESSION['loggedin']) {
    header('location: /acme/');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
  
    <h1 class="siteTitle">You are logged in, <?php echo $_SESSION['clientData']['clientFirstname']?></h1>

    <section>
      
        <ul>
            <li>First name: </li>
            <li>Last name: </li>
            <li>Email Address: </li>
            <li>Client Level: </li>
        </ul>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
