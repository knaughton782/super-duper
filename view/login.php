<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main>
    <section class="loginForm">
    <h1 class="siteTitle">Acme Login Page</h1>
        <?php
            if (isset($_SESSION['message'])) {
                echo  $_SESSION['message'];
                // unset the message after displaying it once
                unset($_SESSION['message']);
            }
        ?>

    <p>*All fields are required</p>
    <br>
    
        <form action="/acme/accounts/" method="post">
            <fieldset>
                <label for="clientEmail">Email Address:</label><br>
                <input type="email" name="clientEmail" id="clientEmail" <?php if (isset($clientEmail)) {
                    echo "value'$clientEmail'";
                } ?> required><br>
                
                <label for='clientPassword'>Password:<br>
                 <span class="warning">Passwords must be at least 8 characters. Please include at least 1 number, 1 capital, and 1 special character.</span>
                </label><br>
               
                <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                
                <input type="submit" name='submit' class="loginBtn" value="Login">
                <input type="hidden" name="action" value="login_user">
            </fieldset>
        </form>
        </section>
        <section>
            <h2>Need to Create an Account?</h2> <br>
            <a href="/acme/index.php?action=register" title="Click to Register for an Account" id="registrationLink">Click to Register</a>
           
        </section>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
