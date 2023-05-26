<?php

use MyProject\php\cat\row\Product;
use MyProject\php\cat\Prod;
use MyProject\php\cat\Cats;

use MyProject\php\cat\Validate;


include "setup.php";
is_logged_in();

include "header.php";

echo "<h1>Edit a product</h1>";


$success = false;

if (!empty($_POST)) {
    // if the formular is sent
    $validate = new Validate();

    $validate->isFilled($_POST["cat_id"], "Category");
    $validate->isFilled($_POST["name"], "Name");
    $validate->isFilled($_POST["description"], "Description");
    $validate->isFilled($_POST["quantity"], "Quantity");
    $validate->isFilled($_POST["unit"], "Unit");
    $validate->isFilled($_POST["price"], "Price");
    $validate->isFilled($_POST["inactive"], "Deactivate");
    $validate->isFilled($_POST["inactive_from"], "Deactivate from");



    if (!$validate->hasErrors()) {
        // if everything is ok... save
        $product = new Product(array(
            "id" => $_GET["id"] ?? null,
            "description" => $_POST["description"],
            "quantity" => $_POST["quantity"],
            "unit" => $_POST["unit"],
            "price" => $_POST["price"],
            "cat_id" => $_POST["cat_id"],
            "inactive" => $_POST["inactive"],
            "inactive_from" => $_POST["inactive_from"],

        ));
        $product->save();
        $success = true;
        }
    
}

?>

<?php
 if ( $success) {
    echo "<p><strong>Product changed.</strong><br>
    <a href='produkte_liste.php'>go back</a></p>";    

 } else {

    if ( !empty($validate) ) {
        echo $validate->errorHtml();
    }

    if (!empty($_GET["id"])) {
        // bearbeiten-modus - Fahrzeugdaten ermitteln
        $product = new Product($_GET["id"]);
    }

?>

    <form action="produkte_bearbeiten.php<?php 
        if (!empty($product)) {
            echo "?id=" . $product->id;
        }
    ?>" method="post">
        <div>
            <label for="cat_id">Category:</label>
            <select name="cat_id" id="cat_id">
                <option value="">- Choose please -</option>
                <?php
                $category = new Cats();
                $allCats = $category->allCats();
                foreach ($allCats as $cat) {
                    echo "<option value='{$cat->id}'";
                    if ( !empty($_POST["cat_id"]) && $_POST["cat_id"] == $cat->id) {
                        echo " selected";
                    } else if (!empty($product) && $product->cat_id == $cat->id) {
                        echo " selected";
                    }
                    echo ">{$cat->titel}</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php if( !empty($_POST["name"]) ) {
                echo htmlspecialchars($_POST["name"]);
            } else if (!empty($product)) {
                echo htmlspecialchars($product->name);
            } ?>">
        </div>

        <div>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="<?php if( !empty($_POST["description"]) ) {
                echo htmlspecialchars($_POST["description"]);
            } else if (!empty($product)) {
                echo htmlspecialchars($product->description);
            } ?>">
        </div>

        <div>
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="quantity" value="<?php if( !empty($_POST["quantity"]) ) {
                echo htmlspecialchars($_POST["quantity"]);
            } else if (!empty($product)) {
                echo htmlspecialchars($product->quantity);
            } ?>">
        </div>

        <div>
            <label for="unit">Unit:</label>
            <input type="text" name="unit" id="unit" value="<?php if( !empty($_POST["unit"]) ) {
                echo htmlspecialchars($_POST["unit"]);
            } else if (!empty($product)) {
                echo htmlspecialchars($product->unit);
            } ?>">
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="<?php if( !empty($_POST["price"]) ) {
                echo htmlspecialchars($_POST["price"]);
            } else if (!empty($product)) {
                echo htmlspecialchars($product->price);
            } ?>">
        </div>

        <div>
            <label for="sorting">Importance:</label>
            <input type="text" name="sorting" id="sorting" value="<?php if( !empty($_POST["sorting"]) ) {
                echo htmlspecialchars($_POST["sorting"]);
            } else if (!empty($product)) {
                echo htmlspecialchars($product->sorting);
            } ?>">
        </div>

        <div>
            <label for="inactive">Deactivate in the menu:</label>
            <input type="checkbox" id="inactive" name="inactive" value="1" <?php
                if (!empty($_POST["inactive"]) && $_POST["inactive"] == 1) {
                echo "checked";
                } else if (!isset($_POST["inactive"]) && empty($product)) {
                 echo "checked";
                }  ?>> 
        </div>
        
        <div>
            <label for="inactive_from">Deactivate from:</label>
            <input type="date" name="inactive_from" id="inactive_from"<?php
            if (!empty($product->inactive_from)) {
            echo ' value="' . htmlspecialchars($product->inactive_from) . '"';
            }?>>
        </div>
       

        <div>
            <button type="submit">Save product</button>
        </div>

    </form>
<?php
 }
 
 include "footer.php";