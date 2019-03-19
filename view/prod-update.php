<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
?><?php
// dynamic drop-down select list made sticky
$catList = '<select name="categoryId" id="categoryId" required>';
$catList .= '<option>Select an option: </option>';
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]' ";
    if (isset($categoryId)) {

        if ($category['categoryId'] === $categoryId) {
            $catList .= ' selected ';
        }
    } elseif (isset($prodInfo['categoryId'])) {
        if ($category['categoryId'] === $prodInfo['categoryId']) {
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>


<main id="page-content"> 
    <section>
    
    <h1><?php
            if (isset($prodInfo['invName'])) {
                echo "Modify $prodInfo[invName] ";
            } 
            elseif (isset($invName)) {
                echo $invName;
            }
        ?></h1>
        <h2>Use this form to update products. All fields are required.</h2><br><br>
    <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            // unset the message after displaying it once
            unset($_SESSION['message']);
        }
        ?>
    

        <form action="/acme/products/index.php" method="post">
            <fieldset>

                <label for="categoryId">Category:</label><br>
                <?php echo $catList; ?><br>
<!-- NAME-->
                <label for="invName">Product Name: </label><br>
                <input type="text" name="invName" id="invName" <?php
                if (isset($invName)) {
                    echo "value='$invName'";
                } elseif (isset($prodInfo['invName'])) {
                    echo "value='$prodInfo[invName]'";
                }
                ?> required><br>
<!-- DESCRIPTION-->
                <label for="invDescription">Product Description: </label><br>
                <textarea name="invDescription" id="invDescription" required ><?php
                    if (isset($invDescription)) { echo $invDescription; } elseif (isset($prodInfo['invDescription'])) {
                        echo $prodInfo['invDescription']; } ?></textarea><br>
<!-- IMAGE-->
                <label for="invImage">Product Image (path to image): </label><br>
                <input type="text" name="invImage" id="invImage" value="/acme/images/no-img.png" required <?php
                if (isset($invImage)) {
                    echo "value='$invImage'";
                } elseif (isset($prodInfo['invImage'])) {
                    echo "value='$prodInfo[invImage]'";
                }
                ?>><br>
<!-- THUMBNAIL-->                
                <label for="invThumbnail">Product Thumbnail (path to thumbnail): </label><br>
                <input type="text" name="invThumbnail" id="invThumbnail" value="/acme/images/no-img.png" required  <?php
                if (isset($invThumbnail)) {
                    echo "value='$invThumbnail'";
                } elseif (isset($prodInfo['invThumbnail'])) {
                    echo "value='$prodInfo[invThumbnail]'";
                }
                ?>><br>
<!-- PRICE-->              
                <label for="invPrice">Product Price: </label><br>
                <input type="number" step=".05" name="invPrice" id="invPrice" required <?php
                if (isset($invPrice)) {
                    echo "value='$invPrice'";
                } elseif (isset($prodInfo['invPrice'])) {
                    echo "value='$prodInfo[invPrice]'";
                }
                ?>><br>
<!-- STOCK-->               
                <label for="invStock">Number in Stock: </label><br>
                <input type="number" name="invStock" id="invStock" required <?php
                if (isset($invStock)) {
                    echo "value='$invStock'";
                } elseif (isset($prodInfo['invStock'])) {
                    echo "value='$prodInfo[invStock]'";
                }
                ?>><br>
<!-- SIZE-->                
                <label for="invSize">Shipping Size (W x H x L in inches): </label><br>
                <input type="number" name="invSize" id="invSize" required <?php
                if (isset($invSize)) {
                    echo "value='$invSize'";
                } elseif (isset($prodInfo['invSize'])) {
                    echo "value='$prodInfo[invSize]'";
                }
                ?>><br>
<!-- WEIGHT-->                
                <label for="invWeight">Weight (lbs.): </label><br>
                <input type="number" name="invWeight" id="invWeight" required <?php
                if (isset($invWeight)) {
                    echo "value='$invWeight'";
                } elseif (isset($prodInfo['invWeight'])) {
                    echo "value='$prodInfo[invWeight]'";
                }
                ?>><br>
<!-- LOCATION-->                
                <label for="invLocation">Location (city name): </label><br>
                <input type="text" name="invLocation" id="invLocation"  <?php
                if (isset($invLocation)) {
                    echo "value='$invLocation'";
                } elseif (isset($prodInfo['invLocation'])) {
                    echo "value='$prodInfo[invLocation]'";
                }
                ?> required><br>
<!-- VENDOR-->                
                <label for="invVendor">Vendor Name: </label><br>
                <input type="text" name="invVendor" id="invVendor" <?php
                if (isset($invVendor)) {
                    echo "value='$invVendor'";
                } elseif (isset($prodInfo['invVendor'])) {
                    echo "value='$prodInfo[invVendor]'";
                }
                ?> required><br>
<!-- STYLE-->               
                <label for="invStyle">Primary Material: </label><br>
                <input type="text" name="invStyle" id="invStyle" <?php
                if (isset($invStyle)) {
                    echo "value='$invStyle'";
                } elseif (isset($prodInfo['invStyle'])) {
                    echo "value='$prodInfo[invStyle]'";
                }
                ?> required><br>

                <input type="submit" name="submit" class="updateProdBtn" value="Update Product">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="updateProd">
                <input type="hidden" name="invId" value="<?php if (isset($prodInfo['invId'])) {
                    echo $prodInfo['invId'];
                } elseif (isset($invId)) {
                    echo $invId;
                } ?>">

            </fieldset>
        </form>

    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
