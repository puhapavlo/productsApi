<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\Product;

class ProductController extends AbstractController
{

    protected $product;

    public function __construct()
    {
        $this->product = new Product();
        parent::__construct();
    }

    public function index()
    {
        if ($this->access->viewUserAccessCheck()) {
            $this->response->json($this->product->getProducts());
        } else {
            $this->response->httpCode(403);
        }
    }

    public function getProduct($id)
    {
        if ($this->access->viewUserAccessCheck()) {
            $this->response->json($this->product->entityToArray($id));
        } else {
            $this->response->httpCode(403);
        }
    }

    public function create()
    {
        if ($this->access->addProductAccessCheck()) {
            $product = new Product();
            $product->name = $this->request->name;
            $product->price = $this->request->price;
            $product->description = $this->request->description;
            $product->picture = $this->request->picture;
            $product->category = $this->request->category;
            $product->status = $this->request->status;
            if ($product->create()) {
                $this->messageResponseService::setMessageForEntity
                (
                    $this->response,
                    $this->messageResponseService::$CREATE_SUCCESS,
                );
            }
        } else {
            $this->response->httpCode(403);
        }
    }

    public function update(int $id): string
    {
        if ($this->access->editUserAccessCheck()) {
            $this->name = $this->request->name;
            $this->price = $this->request->price;
            $this->description = $this->request->description;
            $this->picture = $this->request->picture;
            $this->response->json([$this->product->update($id)]);
        } else {
            $this->response->httpCode(403);
        }
    }

    public function deleteProduct($id)
    {
        $this->response->json($this->product->delete($id));
    }
}

