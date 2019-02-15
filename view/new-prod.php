<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<!--
for adding a new product
select dropdown list for entering category type
this list is dynamically created from db by controller
-->

<main id="page-content"> 

    <h1 class="siteTitle">Add a Product</h1>
    <section class="">
        <form action="" method="">
        <fieldset>
                <label for="clientFirstname">First name: </label><br>
                <input type="text" name="clientFirstname" id="clientFirstname"><br>

                <label for="clientLastname">Last name: </label><br>
                <input type="text" name="clientLastname" id="clientLastname"><br>

                <label for="clientEmail">Email Address: </label><br>
                <input type="email" name="clientEmail" id="clientEmail"><br>

                <label for="clientPassword">Password: </label><br>
                <input type="password" name="clientPassword" id="clientPassword">

                <input type="submit" name="submit" class="registrationBtn" value="Register">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="register">
           
            </fieldset>
        </form>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
