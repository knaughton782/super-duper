 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<main id="page-content"> 
  
    <h1 class="siteTitle">Add A Category</h1>
    <h2>Use this form to add a new category.</h2>
    <p>*All fields are required.</p>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>

    <section>
        <form action="/acme/products/index.php" method="POST">
            <fieldset>
                <label for="categoryName">Name of New Category: </label><br>
                <input type="text" name="categoryName" id="categoryName"><br>
                
                <input type="submit" name="submit" class="addCategoryBtn" value="Add Category">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="addNewCategory">
                
            </fieldset>
            
        </form>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>