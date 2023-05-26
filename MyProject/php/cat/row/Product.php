<?php
namespace MyProject\php\cat\row;

class Product extends RowAbstract {
    protected string $table = "product";

public function cat(): Category {
    return new Category($this->cat_id);
}

}