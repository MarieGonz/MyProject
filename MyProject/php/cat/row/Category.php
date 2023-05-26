<?php
namespace MyProject\php\cat\row;

class Category extends RowAbstract {
    protected string $table = "category";

public function cate(): Category {
    return new Category($this->titel);
}

}
