<?php
use MyProject\php\cat\row\Product;

include "setup.php";
is_logged_in();

include "header.php";

echo "<h1>Delete a product</h1>";

$product = new Product($_GET["id"]);

if ( !empty( $_GET["doit"] ) ) {
    //Bestätigungs_link wurde geklickt -> wirkich aus der DB löschen
    $product->delete();

    echo "<p>Well done, you deleted a product<br>";
    echo "<a href='produkte_liste.php'>Back to product</a></p>";
} else {

    //Benutzer fragen, ob er das Fahrzeug wirklich entfernen will

    echo "<h3>Sure about it?</h3>";
    echo "<strong>Category</strong> ". $product->cat()->titel ."<br />";
    echo "<strong>Name</strong> ". $product->name ."<br />";
    echo "<strong>Description</strong> ". $product->description ."<br />";
    echo "<strong>Quantity</strong> ". $product-> quantity ."<br />";
    echo "<strong>Unit</strong> ". $product-> unit ."<br />";
    echo "<strong>Price</strong> ". $product-> price ."<br />";
    echo "<strong>sorting</strong> ". $product-> sorting ."<br />";


    echo "<p>
        <a href='produkte_liste.php'>No, cancel</a>
        <a href='produkte_entfernen.php?id=". $product->id ."&amp;doit=1'>Yes, I am sure</a>
        </p>";

}
include "footer.php";