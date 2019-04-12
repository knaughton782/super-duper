<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content">

    <h1 class="siteTitle">Image Management</h1>


    <p>Welcome to the image management page! Please choose one of the options below:</p>

    <section>

        <h2>Add New Product Image</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo  $_SESSION['message'];
            // unset the message after displaying it once
            unset($_SESSION['message']);
        }
        ?>

        <form action="/acme/uploads/" method="post" enctype="multipart/form-data">

            <label for="invItem">Product</label><br>
            <?php echo $prodSelect; ?><br><br>

            <label>Upload Image:</label><br>
            <input type="file" name="file1"><br>

            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">

        </form>
        <hr>
        <h2>Existing Images</h2>
        <p class="warning">If deleting an image, delete the thumbnail too and vice versa.</p>
        <?php
        if (isset($imageDisplay)) {
            echo $imageDisplay;
        }
        ?>


    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>