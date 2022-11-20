<?php

namespace Pablo\ApiProduct\Term;

use Pablo\ApiProduct\exceptions\BundleNotExistException;

class Term
{
    public function getTermBundle($type)
    {
        switch ($type) {
            case 'status':
                return new Status();
                break;
            case 'category':
                return new Category();
                break;
            default:
                throw new BundleNotExistException($type);
        }
    }
}
