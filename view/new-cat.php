 <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>

<!-- only requires a new name
 auto incrementing id so you don't need to ask for that-->
 

<main id="page-content"> 
  
    <h1 class="siteTitle">Add A New Category</h1>

    <section>
        <form action="" method="">
            <fieldset>
                <label for="categoryName"> </label><br>
                <input type="text" name="categoryName" id="categoryName"><br>
                
                <input type="submit" name="submit" class="" value="Add Category">
                <!--add the action key/value pair-->
                <input type="hidden" name="action" value="">
                
            </fieldset>
            
        </form>
    </section>

</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>