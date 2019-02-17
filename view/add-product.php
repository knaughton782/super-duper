<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<?php
    if (isset($message)) {
        echo $message;
    }
    ?>
<main id="page-content"> 

    <h1 class="siteTitle">Add a Product</h1>
    <h2>Use this form to add a new product. </h2>
    <p>*All fields are required.</p>
    <section>
    
    <form action="/acme/products/index.php" method="post">
        <fieldset>
            <p id="selectCategory">
                <label for="categoryId">Category:</label><br>
                <?php echo $catList;?>
            </p>
                <label for="invName">Product Name: </label><br>
                <input type="text" name="invName" id="invName"><br>

                <label for="invDescription">Product Description: </label><br>
                <input type="text" name="invDescription" id="invDescription"><br>

                <label for="invImage">Product Image (path to image): </label><br>
                <input type="text" name="invImage" id="invImage" ><br>
                <!--TODO: google hard-coding images into form fields-->
                <label for="invThumbnail">Product Thumbnail (path to thumbnail): </label><br>
                <input type="text" name="invThumbnail" id="invThumbnail" ><br>
                
                 <label for="invPrice">Product Price: </label><br>
                <input type="text" name="invPrice" id="invPrice"><br>
                
                 <label for="invStock">Number in Stock: </label><br>
                <input type="text" name="invStock" id="invStock"><br>
                
                 <label for="invSize">Shipping Size (W x H x L in inches): </label><br>
                <input type="text" name="invSize" id="invSize"><br>
                
                 <label for="invWeight">Weight (lbs.): </label><br>
                <input type="text" name="invWeight" id="invWeight"><br>
                
                 <label for="invLocation">Location (city name): </label><br>
                <input type="text" name="invLocation" id="invLocation"><br>
                
                 <label for="invVendor">Vendor Name: </label><br>
                <input type="text" name="invVendor" id="invVendor"><br>
                
                 <label for="invStyle">Primary Material: </label><br>
                <input type="text" name="invStyle" id="invStyle"><br>

                <input type="submit" name="submit" class="addProductBtn" value="Add Product">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="add-product">
           
            </fieldset>
        </form>
  
    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
