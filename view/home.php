<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
<main>

<h1 class="siteTitle">Welcome to Acme!</h1>

<!-- Hero description text-->
<section id="heroSection">
    <!-- hero image goes here -->

    <ul class="acmeRocket">
        <li><h2>Acme Rocket</h2></li>
        <li>Quick lighting fuse</li>
        <li>NHTSA approved seat belts</li>
        <li>Mobile launch stand included</li>
        <li><a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
    </ul>
</section>

<section class="reviewsRecipes">
    <!--Hero Product Review text-->
    <div class="reviews">
        <h3>Acme Rocket Reviews</h3>
        <ul class="rocketReviews">
            <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
            <li>"That thing was fast!" (4/5)</li>
            <li>"Talk about fast delivery." (5/5)</li>
            <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
            <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
        </ul>
    </div>
    <div class="recipes">
        <!--Recipe Text-->
        <h3>Featured Recipes</h3>
        <table class="recipeImages">
            <tr>
                <td class="img"><img src="/acme/images/recipes/bbqsand.jpg" alt="bbq" title="image for bbq sandwich"></td>
                <td class="img"><img src="/acme/images/recipes/potpie.jpg" alt="potpie" title="image for pot pie"></td>
            </tr>
            <tr>
                <td><a href="#" title="See the recipe for Roadrunner BBQ sandwich">Pulled Roadrunner BBQ</a></td>
                <td><a href="#" title="See the recipe for Roadrunner Pot Pie">Roadrunner Pot Pie</a></td>
            </tr>
            <tr>
                <td class="img"><img src="/acme/images/recipes/soup.jpg" alt="soup" title="roadrunner soup"></td>
                <td class="img"><img src="/acme/images/recipes/taco.jpg" alt="taco" title="roadrunner tacos"></td>
            </tr>
            <tr>
                <td><a href="#"  title="See the recipe for Roadrunner Soup">Roadrunner Soup</a></td>
                <td><a href="#"  title="See the recipe for Roadrunner Tacos">Roadrunner Tacos</a></td>

            </tr>

        </table>
    </div>
</section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
