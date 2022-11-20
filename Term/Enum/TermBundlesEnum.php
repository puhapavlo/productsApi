<?php

namespace Pablo\ApiProduct\Term;

enum TermBundlesEnum
{
    case STATUS;
    case CATEGORY;


    public function class() {
        return match ($this) {
            TermBundlesEnum::STATUS => new Status(),
            TermBundlesEnum::CATEGORY => new Category(),
        };
    }
}