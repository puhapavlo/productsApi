<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Term\Category;

class CategoryTermController extends AbstractController {
    public function addTerm() {
        $category = new Category();
        $category->name = $this->request->name;
        $category->create();
    }
}
