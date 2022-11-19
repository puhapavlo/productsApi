<?php

namespace Pablo\ApiProduct\exceptions;

class BundleNotExistException extends \Exception
{
    protected $bundleName;

    public function __construct($bundleName) {
        $this->bundleName = $bundleName;
        parent::__construct();
    }

    public function __toString() {
        return "Bundle $this->bundleName does not exist";
    }
}