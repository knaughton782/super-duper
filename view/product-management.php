<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<!-- Product Management View -->

<main id="page-content"> 

    <h1 class="siteTitle">Product Management</h1>
    <h2>Add a Category or a Product</h2>

    <section class="prodMgt">
        <p>Please choose an option:</p>
        <br>
        <ul>
            <li><a href="/acme/products/index.php?action=add-category">Add a New Category</a></li> 
            <li><a href="/acme/products/index.php?action=add-product">Add a New Product</a></li>
        </ul>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>

