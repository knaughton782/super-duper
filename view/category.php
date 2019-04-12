<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<main id="page-content">

    <h1 class="siteTitle"><?php echo $categoryName; ?> Products</h1>

    <section>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];

            unset($_SESSION['message']);
        }
        ?>

        <?php if (isset($prodDisplay)) {
            echo $prodDisplay;
        }
        ?>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>