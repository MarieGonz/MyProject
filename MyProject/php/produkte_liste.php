<?php

use MyProject\php\cat\Prod;


include "setup.php";
is_logged_in();
include "header.php";

?>
<h1>Products</h1>
<p><a href="produkte_neu.php">Add a new product</a></p>
<p><a href="category_liste.php">Check a category</a></p>


<?php
// Retrieve the parameters for sorting, showing/hiding, and grouping
$sort = $_GET['sort'] ?? 'name'; // Default sorting by name
$showHidden = $_GET['show_hidden'] ?? false; // Default is not showing hidden products
$groupByCategory = $_GET['group_by_category'] ?? false; // Default is not grouping by category

// Instantiate the product class
$products = new Prod();

// Get the products with the specified sorting, showing/hiding, and grouping
//$allProducts = $products->getProducts($sort, $showHidden, $groupByCategory);

echo "<table border='1'>";

    echo "<thead>";
    echo "<th>Category</th>";
    echo "<th>Titel</th>";
    echo "<th>Untertiel</th>";
    echo "<th>Quantity</th>";
    echo "<th>Unit</th>";
    echo "<th>Price</th>";
    echo "<th>Sorting</th>";



    echo "</thead>";
    echo "<tbody>";

    $products = new Prod();
    $allProducts = $products->allProducts();

    usort($allProducts, function($a, $b) {
        return $a->sorting - $b->sorting;
    });

    foreach ($allProducts as $menu) {
        echo "<tr>";
        echo "<td>" . $menu->cat()->titel . "</td>";
        echo "<td>" . $menu->name . "</td>";
        echo "<td>" . $menu->description . "</td>";
        echo "<td>" . $menu->quantity . "</td>";
        echo "<td>" . $menu->unit . "</td>";
        echo "<td>" . $menu->price . "</td>";
        echo "<td>" . $menu->sorting . "</td>";



        echo "<td>" . "<a href='produkte_bearbeiten.php?id={$menu->id}'>Edit</a>" . "<br>"
        ."<a href='produkte_entfernen.php?id={$menu->id}'>Delete</a>". "</td>";

    echo "</tr>";
    }
echo "</tbody>";
echo "</table>";

    


include "footer.php";

