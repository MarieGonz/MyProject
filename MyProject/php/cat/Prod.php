<?php
namespace MyProject\php\cat;

use MyProject\php\cat\row\Product;
use MyProject\php\cat\Mysql;

class Prod {
    /**
     * Gibt alle Fahrzeuge zurück.
     * @return array Ein array mit mehreren Fahrzeug Objekten drin.
     */
    public function allProducts(): array {
        $db = Mysql::getInstance();

        $everyProduct = array();
        $result = $db->query("SELECT * FROM product");
        while ($row = $result->fetch_assoc()) {
            $everyProduct[] = new Product($row);
        }
        return $everyProduct;
    }
}