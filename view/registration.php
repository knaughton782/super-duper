<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main>
    <h1 class="siteTitle">Acme Registration</h1>
    <p>All fields are required.</p>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>

    <section>

        <form action="/acme/accounts/index.php" method="post">

            <fieldset>
                <label for="clientFirstname">First name: </label><br>
                <input type="text" name="clientFirstname" id="clientFirstname" 
                       <?php if (isset($clientFirstname)) {
                           echo "value='$clientFirstname'";
                       } ?> required><br>

                <label for="clientLastname">Last name: </label><br>
                <input type="text" name="clientLastname" id="clientLastname" <?php if (isset($clientLastname)) {
                           echo "value='$clientLastname'";
                       }
                       ?> required><br>

                <label for="clientEmail">Email Address: </label><br>
                <input type="email" name="clientEmail" id="clientEmail"  placeholder="Pleae enter a valid email address" 
<?php if (isset($clientEmail)) {
    echo "value='$clientEmail'";
} ?> required><br>

                <label for="clientPassword">Password: <br>
                    <span class="instructions">Passwords must be at least 8 characters. Please include at least 1 number, 1 capital, and 1 special character.</span></label><br>
                <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                <label>&nbsp;</label>
                <input type="submit" name="submit" class="registrationBtn" value="Register">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="register">

            </fieldset>
        </form>
    </section>


</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
