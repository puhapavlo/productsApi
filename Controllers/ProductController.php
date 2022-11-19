<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\Product;
use Pablo\ApiProduct\Entity\User;

class ProductController extends AbstractController
{
    public function index():string
    {
        return $this->response->json([
            [
                'name' => 'project 1'
            ],
            [
                'name' => 'project 2'
            ]
        ]);
    }

    public function create()
    {
        $product = new Product();
        $product->name = $this->request->name;
        $product->price = $this->request->price;
        $product->description = $this->request->description;
        $product->picture = $this->request->picture;
        $product->category = $this->request->category;
        $product->status = $this->request->status;

        return $product->create();
    }

    public function update(int $id): string
    {
        return $this->response->json([
            [
                'response' => 'OK',
                'request' => $this->request->project,
                'id' => $id
            ]
        ]);
    }
}

