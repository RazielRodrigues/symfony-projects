<?php

namespace App\MessageHandler\Query;
use App\Message\Query\SearchQuery;

class SearchQueryHandler
{

    public function __invoke(SearchQuery $searchQuery)
    {
        dump($searchQuery);
        return 'results from database';
    }

}
