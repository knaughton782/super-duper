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

    <h1><?php if (isset($revInfo['reviewId'])) {
            echo "Delete $revInfo[reviewId]";
        } ?></h1>
    <h2>Please be sure you want to delete the review. This action is permanent!</h2>
    <section>

        <form action="/acme/reviews/" method="post">
            <fieldset>

                <!-- NAME-->
                <label for="reviewId">Review: </label><br>
                <input type="text" name="reviewId" id="reviewId" 
                    <?php if (isset($revInfo['reviewText'])) {
                        
                        echo "value='$revInfo[reviewText]'";
                        
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