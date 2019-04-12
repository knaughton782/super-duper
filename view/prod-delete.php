<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>


<main id="page-content">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        // unset the message after displaying it once
        unset($_SESSION['message']);
    }
    ?>

    <h1><?php if (isset($prodInfo['invName'])) {
            echo "Delete $prodInfo[invName]";
        } ?></h1>
    <h2>Please be sure you want to delete the product before completing this form. The delete is permanent!</h2>
    <section>

        <form action="/acme/products/index.php" method="post">
            <fieldset>

                <!-- NAME-->
                <label for="invName">Product Name: </label><br>
                <input type="text" name="invName" id="invName" 
                    <?php if (isset($prodInfo['invName'])) {
                        
                        echo "value='$prodInfo[invName]'";
                        
                        } ?> readonly><br>


                <!-- DESCRIPTION-->
                <label for="invDescription">Product Description: </label><br>
                <textarea name="invDescription" id="invDescription" readonly><?php
                                                                                if (isset($prodInfo['invDescription'])) {
                                                                                    echo $prodInfo['invDescription'];
                                                                                } ?></textarea><br>


                <input type="submit" name="submit" class="deleteProdBtn" value="Delete Product">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" value="<?php if (isset($prodInfo['invId'])) {
                                                                echo $prodInfo['invId'];
                                                            } ?>">

            </fieldset>
        </form>

    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>