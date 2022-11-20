<?php

namespace Pablo\ApiProduct\Term;

/**
 * Term bundle interface.
 */
interface TermBundleInterface
{
    /**
     * Method for return all terms for current bundle.
     *
     * @return array
     *  Return array with terms.
     */
    public function getTerms(): array;
}
