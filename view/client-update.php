<?php if (!$_SESSION['loggedin']) {
     header('location: /acme/accounts?action=login');
    exit;
}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main id="page-content"> 
    
  <!--  ACCOUNT UPDATE  -->
  
  <section class="updateForm">
    <h1 class="siteTitle">Account Updates</h1>

    <p>Update your profile information here:</p><br>
    
        <form action="/acme/accounts/" method="post">
            <fieldset>
                <label for="clientFirstname">First name: </label><br>
                <input type="text" name="clientFirstname" id="clientFirstname" <?php if (isset($clientFirstname)) { 
                    echo "value='$clientFirstname'"; } ?> required>
                <br>

                <label for="clientLastname">Last name: </label><br>
                <input type="text" name="clientLastname" id="clientLastname" <?php if (isset($clientLastname)) {
                    echo "value='$clientLastname'"; } ?> required>
                <br>

                <label for="clientEmail">Email Address: </label><br>
                <input type="email" name="clientEmail" id="clientEmail" placeholder="Pleae enter a valid email address" 
                    <?php if (isset($clientEmail)) { echo "value='$clientEmail'"; } ?> required>
                <br>
                
                <input type="submit" name='submit' class="loginBtn" value="Update Profile">
                <input type="hidden" name="action" value="update_user">
                <input type="hidden" name="clientId" value="<?php if (isset($clientData['clientId'])) {
                echo $clientData['clientId']; }
                elseif (isset($clientId)) {
                echo $clientId;}
                ?>">
            </fieldset>
        </form>
    </section>
    
    
    <!--  PASSWORD UPDATE  -->
    <section class="updateForm">
    
    <h1 class="siteTitle">Change Password</h1>

    <p>Change your password here:</p><br>
    
        <form action="/acme/accounts/" method="post">
            <fieldset>
                
                <label for='clientPassword'>Password:<br>
                 <span class="warning">Passwords must be at least 8 characters. Please include at least 1 number, 1 capital, and 1 special character.</span>
                </label>
                <br>
                <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                <br>
                
                <input type="submit" name='submit' class="loginBtn" value="Update Password">
                <input type="hidden" name="action" value="update_pw">
                <input type="hidden" name="clientId" value="<?php if (isset($clientInfo['clientId'])) {
                echo $clientInfo['clientId']; }
                elseif (isset($clientId)) {
                echo $clientId;}
                ?>">
            </fieldset>
        </form>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
