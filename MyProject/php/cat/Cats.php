<?php
namespace MyProject\php\cat;

use MyProject\php\cat\row\Category;
use MyProject\php\cat\Mysql;

class Cats {
    /**
     * Gibt alle Marken zurück.
     * @return array Ein array mit mehreren Marke Objekten drin.
     */
    public function allCats(): array {
        $db = Mysql::getInstance();

        $everyCat = array();
        $result = $db->query("SELECT * FROM category");
        while ($row = $result->fetch_assoc()) {
            $everyCat[] = new Category($row);
        }
        return $everyCat;
    }
}