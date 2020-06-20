<?php

namespace App\Filters;

use App\Filters\Filter;

class Category extends Filter
{

    protected function applyFilters($builder)
    {

        return $builder->where('category_id', request($this->filterName()));
    }
}
