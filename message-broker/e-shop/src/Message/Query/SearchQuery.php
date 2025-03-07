<?php

namespace App\Message\Query;

class SearchQuery
{

    private $term;

    public function __construct(string $term) {
        $this->term = $term;
    }

    public function getTerm(): string
    {
        return $this->term;
    }
    
}
