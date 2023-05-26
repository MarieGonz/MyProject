<?php

use MyProject\php\cat\row\Category;
use MyProject\php\cat\Prod;
use MyProject\php\cat\Cats;

use MyProject\php\cat\Validate;


include "setup.php";
is_logged_in();

include "header.php";

echo "<h1>Edit a category</h1>";


$success = false;

if (!empty($_POST)) {
    // if the formular is sent
    $validate = new Validate();
    $validate->isFilled($_POST["titel"], "titel");
   

    if (!$validate->hasErrors()) {
        // if everything is ok... save
        $cat = new Category(array(
            "id" => $_GET["id"] ?? null,
            "titel" => $_POST["titel"],

        ));
        $cat->save();
        $success = true;
        }
    
}

?>

<?php
 if ( $success) {
    echo "<p><strong>Category changed.</strong><br>
    <a href='myaccount.php'>go back</a></p>";    

 } else {

    if ( !empty($validate) ) {
        echo $validate->errorHtml();
    }

    if (!empty($_GET["id"])) {
        // bearbeiten-modus - Fahrzeugdaten ermitteln
        $cat = new Category($_GET["id"]);
    }

?>

    <form action="category_bearbeiten.php<?php 
        if (!empty($cat)) {
            echo "?id=" . $cat->id;
        }
    ?>" method="post">

        <div>
            <label for="titel">Titel:</label>
            <input type="text" name="titel" id="titel" value="<?php if( !empty($_POST["titel"]) ) {
                echo htmlspecialchars($_POST["titel"]);
            } else if (!empty($cat)) {
                echo htmlspecialchars($cat->titel);
            } ?>">
        </div>

+
       

        <div>
            <button type="submit">Save cat</button>
        </div>

    </form>
<?php
 }
 
 include "footer.php";