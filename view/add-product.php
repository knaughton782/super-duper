<?php if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
?><?php // dynamic drop-down select list made sticky
    $catList = '<select name="categoryId" id="categoryId" required>';
    $catList .= '<option>Select an option: </option>';
        foreach ($categories as $category) {
            $catList .= "<option value='$category[categoryId]' ";
        if(isset($categoryId)) {
            
            if($category['categoryId'] === $categoryId) {
                $catList .= ' selected ';
            }
        }
            $catList .= ">$category[categoryName]</option>";
        }
   $catList .= '</select>';
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        
<main id="page-content"> 
    <section>

    <h1 class="siteTitle">Add a Product</h1>
    <?php
            if (isset($_SESSION['message'])) {
                echo  $_SESSION['message'];
                // unset the message after displaying it once
                unset($_SESSION['message']);
            }
        ?>
    <h2>Use this form to add a new product. </h2><br><br>
    
    
    <form action="/acme/products/index.php" method="post">
        <fieldset>

                <label for="categoryId">Category:</label><br>
                <?php echo $catList;?><br>
<!-- NAME-->
                <label for="invName">Product Name: </label><br>
                <input type="text" name="invName" id="invName" <?php if (isset($invName)) {
                    echo "value='$invName'"; } ?> required><br>
<!-- DESCRIPTION-->
                <label for="invDescription">Product Description: </label><br>
                <textarea name="invDescription" id="invDescription" required ><?php if (isset($invDescription)) {
                    echo $invDescription; } ?></textarea><br>
<!-- IMAGE-->
                <label for="invImage">Product Image (path to image): </label><br>
                <input type="text" name="invImage" id="invImage" value="/acme/images/no-img.png"  <?php if (isset($invImage)) {
                    echo "value='$invImage'";
                    } ?> required><br>
<!-- THUMBNAIL-->                
                <label for="invThumbnail">Product Thumbnail (path to thumbnail): </label><br>
                <input type="text" name="invThumbnail" id="invThumbnail" value="/acme/images/no-img.png" <?php if (isset($invThumbnail)) {
                    echo "value='$invThumbnail'";
                    } ?> required><br>
 <!-- PRICE-->              
                 <label for="invPrice">Product Price: </label><br>
                 <input type="number" step="0.05" name="invPrice" id="invPrice" <?php if (isset($invPrice)) {
                    echo "value='$invPrice'";
                    } ?> required><br>
<!-- STOCK-->               
                 <label for="invStock">Number in Stock: </label><br>
                 <input type="number" name="invStock" id="invStock" <?php if (isset($invStock)) {
                    echo "value='$invStock'";
                    } ?> required><br>
<!-- SIZE-->                
                 <label for="invSize">Shipping Size (W x H x L in inches): </label><br>
                 <input type="number" name="invSize" id="invSize" <?php if (isset($invSize)) {
                    echo "value='$invSize'";
                    } ?> required><br>
<!-- WEIGHT-->                
                 <label for="invWeight">Weight (lbs.): </label><br>
                 <input type="number" name="invWeight" id="invWeight" <?php if (isset($invWeight)) {
                    echo "value='$invWeight'";
                    } ?> required><br>
<!-- LOCATION-->                
                 <label for="invLocation">Location (city name): </label><br>
                 <input type="text" name="invLocation" id="invLocation"  <?php if (isset($invLocation)) {
                    echo "value='$invLocation'";
                    } ?> required><br>
<!-- VENDOR-->                
                 <label for="invVendor">Vendor Name: </label><br>
                 <input type="text" name="invVendor" id="invVendor" <?php if (isset($invVendor)) {
                    echo "value='$invVendor'";
                    } ?> required><br>
<!-- STYLE-->               
                 <label for="invStyle">Primary Material: </label><br>
                 <input type="text" name="invStyle" id="invStyle" <?php if (isset($invStyle)) {
                    echo "value='$invStyle'";
                    } ?> required><br>

                <input type="submit" name="submit" class="addProductBtn" value="Add Product">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="addProd">
           
            </fieldset>
        </form>
  
    </section>
   
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
