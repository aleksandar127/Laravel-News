<?php

namespace App\Filters;

use App\Filters\Filter;

class Search extends Filter
{

    protected function applyFilters($builder)
    {

        return $builder->where(function ($query) {
            $query->where('text', 'LIKE', '%' . request($this->filterName()) . '%')
                ->orWhere('title', 'LIKE', '%' . request($this->filterName()) . '%');
        });
    }
}
