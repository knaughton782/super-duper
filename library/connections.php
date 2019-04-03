<?php

function acmeConnect() {
    $server = 'localhost';
    $dbname = 'acme';
    $username = 'iClient';
    $password = 'j6IRAOeUJiDIWXaw';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch (PDOException $e) {
        header('Location: /acme/view/500.php');
        exit;
    }
}

acmeConnect();
?>


<!--
Admin user:
Firstname: Admin
Lastname: User
Email: admin@cit336.net
Password: Sup3rU$er  -->


<!--
non-Admin user:
Firstname: Kirsten
Lastname: Naughton
Email: kirsten.naughton@gmail.com
Password: Password1!
-->