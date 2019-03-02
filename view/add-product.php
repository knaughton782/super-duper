<?php // dynamic drop-down select list
    $catList = '<select name="categoryId" id="categoryId">';
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
<?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<main id="page-content"> 

    <h1 class="siteTitle">Add a Product</h1>
    <h2>Use this form to add a new product. </h2>
    <section>
    
    <form action="/acme/products/index.php" method="post">
        <fieldset>

                <label for="categoryId">Category:</label><br>
                <?php echo $catList;?>

                <label for="invName">Product Name: </label><br>
                <input type="text" name="invName" id="invName" 
                    <?php if (isset($invName)) {
                    echo "value='$invName'";
                    } ?> required><br>
<br>

                <label for="invDescription">Product Description: </label><br>
                <input type="textarea" name="invDescription" id="invDescription" required ><?php if (isset($invDescription)) {
                    echo "value='$invDescription'";
                    } ?></input><br>

                <label for="invImage">Product Image (path to image): </label><br>
                <input type="url" name="invImage" id="invImage" value="/acme/images/no-img.png" required <?php if (isset($invImage)) {
                    echo "value='$invImage'";
                    } ?>><br>
                
                <label for="invThumbnail">Product Thumbnail (path to thumbnail): </label><br>
                <input type="url" name="invThumbnail" id="invThumbnail" value="/acme/images/no-img.png" required  <?php if (isset($invThumbnail)) {
                    echo "value='$invThumbnail'";
                    } ?>><br>
                
                 <label for="invPrice">Product Price: </label><br>
                 <input type="number" step=".05" name="invPrice" id="invPrice" required <?php if (isset($invPrice)) {
                    echo "value='$invPrice'";
                    } ?>><br>
                
                 <label for="invStock">Number in Stock: </label><br>
                 <input type="number" name="invStock" id="invStock" required <?php if (isset($invStock)) {
                    echo "value='$invStock'";
                    } ?>><br>
                
                 <label for="invSize">Shipping Size (W x H x L in inches): </label><br>
                 <input type="number" name="invSize" id="invSize" required <?php if (isset($invSize)) {
                    echo "value='$invSize'";
                    } ?>><br>
                
                 <label for="invWeight">Weight (lbs.): </label><br>
                 <input type="number" name="invWeight" id="invWeight"required <?php if (isset($invWeight)) {
                    echo "value='$invWeight'";
                    } ?>><br>
                
                 <label for="invLocation">Location (city name): </label><br>
                 <input type="text" name="invLocation" id="invLocation"  <?php if (isset($invLocation)) {
                    echo "value='$invLocation'";
                    } ?> required><br>
                
                 <label for="invVendor">Vendor Name: </label><br>
                 <input type="text" name="invVendor" id="invVendor" <?php if (isset($invVendor)) {
                    echo "value='$invVendor'";
                    } ?> required<br>
                
                 <label for="invStyle">Primary Material: </label><br>
                 <input type="text" name="invStyle" id="invStyle" <?php if (isset($invStyle)) {
                    echo "value='$invStyle'";
                    } ?> required<br>

                <input type="submit" name="submit" class="addProductBtn" value="Add Product">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="addProd">
           
            </fieldset>
        </form>
  
    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
