<?php if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<!-- Product Management View -->

<main id="page-content"> 
    
    <?php
        if (isset($_SESSION['message'])) {
            echo  $_SESSION['message'];
            // unset the message after displaying it once
            unset($_SESSION['message']);
        }
    ?>

    <h1 class="siteTitle">Product Management</h1>
    <h2>Add a Category or a Product</h2>

    <section class="prodMgt">
        <p>Please choose an option:</p>
        <br>
        <ul>
            <li><a href="/acme/products/index.php?action=addCat" title="Add a new Category">Add a New Category</a></li> 
            <li><a href="/acme/products/index.php?action=addProd" title="Add a new Product">Add a New Product</a></li>
        </ul>
        
        <?php
             if (isset($prodList)) {
                echo $prodList;
            }
        ?>
    </section>
    
    
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

