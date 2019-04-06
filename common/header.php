<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/acme/css/styles.css" type="text/css" media="screen" >
        <title><?php
            if (isset($page_title)) {
                echo $page_title . ' | ';
            }
            ?>Acme, Inc.</title>
    </head>

    <body>
        <!--<div id="content-wrapper">-->

        <header id="headerContainer">
            <div class="headerImages">
                <img src="/acme/images/site/logo.gif" alt="Acme Logo" title="ACME's Home Page to Purchase Coyote Catching Products" class="logo">
                <div class="myAccount">
                    <img src="/acme/images/site/account.gif" alt="My Account Icon" title="Access Your Account" class="account">
                    <?php
                    if (isset($cookieFirstname)) {
                        echo "<span>Welcome $cookieFirstname!</span>";
                    }
                    ?>

                    <?php if (isset($_SESSION['loggedin'])) { ?>
                        <a href="/acme/accounts/index.php?action=logout" title="Click to Log out">Logout</a>

                    <?php
                    }
                    else {
                        ?>
                        <a href="/acme/accounts/index.php?action=login" title="Login to your account">My Account</a>
<?php } ?>

                </div>
            </div>
            <nav id="nav">

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation.php'; ?>

            </nav>
        </header>





