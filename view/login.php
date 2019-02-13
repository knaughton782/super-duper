<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main>
    <h1 class="siteTitle">Acme Login Page</h1>
        <?php
    if (isset($message)) {
        echo $message;
    }
    ?>

    <p>*All fields are required</p>
    <section class="loginForm">
        <form action="/acme/accounts/index.php" method="post">
            <fieldset>


                <label for="clientEmail">Email Address:</label><br>
                <input type="email" name="clientEmail" id="clientEmail"><br>
                
                <label for='clientPassword'>Password:</label><br>
                <input type="password" name='clientPassword' id='clientPassword' ><br>
                
                <input type="submit" name='submit' class="loginBtn" value="Login">
                <input type="hidden" name="action" value="signin">
            <fieldset>
        </form>
        </section>
        <section>
            <h2>Need to Create an Account?</h2> <br>
            <a href="/acme/index.php?action=register" title="Click to Register for an Account" id="registrationLink">Click to Register</a>
            <!--TODO: Style link to look like button-->
        </section>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>