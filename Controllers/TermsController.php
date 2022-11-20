<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\Enum\EntityTypeEnum;
use Pablo\ApiProduct\exceptions\BundleNotExistException;
use Pablo\ApiProduct\Term\Category;
use Pablo\ApiProduct\Term\Status;
use Pablo\ApiProduct\Term\Term;
use PDO;

class TermsController extends AbstractController
{

    protected $termBundle;

    protected $term;


    public function __construct()
    {
        $this->term = new Term();
        $this->entity = EntityTypeEnum::USER->class();
        parent::__construct();
    }

    /**
     * @throws BundleNotExistException
     */
    public function getTerms($type)
    {
        if ($this->access->viewTermAccessCheck()) {
            $this->termBundle = $this->term->getTermBundle($type);
            $this->response->json($this->termBundle->getTerms());
        } else {
            $this->response->httpCode(403);
        }
    }

    public function getTerm($type, $id) {
        if ($this->access->viewTermAccessCheck()) {
            $this->termBundle = $this->term->getTermBundle($type);
            $this->response->json($this->termBundle->entityToArray($id));
        } else {
            $this->response->httpCode(403);
        }
    }

    public function deleteTerm($type, $id) {
        if ($this->access->deleteTermAccessCheck()) {
            $this->termBundle = $this->term->getTermBundle($type);
            $this->response->json($this->termBundle->delete($id));
        } else {
            $this->response->httpCode(403);
        }
    }
}