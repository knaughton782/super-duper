<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main>
    <h1 class="siteTitle">Login Page</h1>

    <p>*All fields are required</p>
    <section class="loginForm">
        <form>
            <label>Email Address:</label><br>
            <input type="email"><br>
            <label>Password:</label><br>
            <input type="password"><br>
            <input type="submit" value="Submit">
        </form>
    </section>
    <section>
        Need to Create an Account? <br>
        <a href="/acme/index.php?action=registration">Click to Register</a>
        <!--TODO: Style link to look like button-->
    </section>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
