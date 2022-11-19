<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\exceptions\BundleNotExistException;
use Pablo\ApiProduct\Term\Category;
use Pablo\ApiProduct\Term\Status;
use PDO;

class TermsController extends AbstractController {

    protected $termBundle;

    /**
     * @throws BundleNotExistException
     */
    public function getTerms()
    {
        switch ($this->request->type) {
            case 'status':
                $this->termBundle = new Status();
                break;
            case 'category':
                $this->termBundle = new Category();
                break;
            default:
                throw new BundleNotExistException($this->request->type);
        }



        $this->response->json($this->termBundle->getTerms());

    }

    public function getTerm() {
        switch ($this->request->type) {
            case 'status':
                $this->termBundle = new Status();
                break;
            case 'category':
                $this->termBundle = new Category();
                break;
            default:
                throw new BundleNotExistException($this->request->type);
        }

        $this->response->json($this->termBundle->getTerm());
    }
}