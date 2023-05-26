<?php

use MyProject\php\cat\row\Product;
use MyProject\php\cat\Prod;
use MyProject\php\cat\Cats;
use MyProject\php\cat\Validate;
use MyProject\php\cat\Mysql;



include "setup.php";
is_logged_in();

include "header.php";
$db = Mysql::getInstance();

echo "<h1>Add a product</h1>";

$success = false;
$error = "";

if (!empty($_POST)) {
    // Check if all fields are filled
    if (!empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["quantity"]) && !empty($_POST["unit"]) && !empty($_POST["price"])) {
        // Create a new Product object with the provided form data
        $product = new Product(array(
            "name" => $_POST["name"],
            "description" => $_POST["description"],
            "quantity" => $_POST["quantity"],
            "unit" => $_POST["unit"],
            "price" => $_POST["price"],
        ));
        
        // Save the product directly to the database
        $product->$db->save();
        
        $success = true;
    } else {
        $error = "All fields are required.";
    }
}

if ($success) {
    echo "<p><strong>Product created.</strong><br>
    <a href='myaccount.php'>Go back</a></p>";
} else {
    // Fetch all categories
    $category = new Cats();
    $allCats = $category->allCats();

    ?>

    <form action="produkte_neu.php" method="post">
        <!-- Category dropdown menu -->
        <div>
            <label for="cat_id">Category:</label>
            <select name="cat_id" id="cat_id">
                <option value="">- Choose a category -</option>
                <?php
                foreach ($allCats as $cat) {
                    echo "<option value='{$cat->id}'>{$cat->titel}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Form fields for product information -->
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="">
        </div>

        <div>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="">
        </div>

        <div>
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="quantity" value="">
        </div>

        <div>
            <label for="unit">Unit:</label>
            <input type="text" name="unit" id="unit" value="">
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="">
        </div>

        <?php
        if (!empty($error)) {
            echo "<p style='color: red;'>{$error}</p>";
        }
        ?>

        <div>
            <button type="submit">Save product</button>
        </div>
    </form>

    <?php
}

include "footer.php";

