<?php

namespace Pablo\ApiProduct\Controllers;

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

