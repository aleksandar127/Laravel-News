<?php

namespace App\Filters;

use Closure;
use Illuminate\Support\Str;



abstract class Filter
{
    public function handle($request, Closure $next)
    {
        $name = $this->filterName();

        if (!request()->has($this->filterName()) || !request()->$name) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilters($builder);
    }

    protected abstract function applyFilters($builder);

    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
}
