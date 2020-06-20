<?php

namespace App\Filters;

use App\Filters\Filter;

class Sort extends Filter
{

    protected function applyFilters($builder)
    {
        return $builder->orderBy('created_at', request($this->filterName()));
    }
}
