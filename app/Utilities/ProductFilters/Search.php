<?php

namespace App\Utilities\ProductFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class Search extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', '%' . $value . '%')
                  ->orWhereHas('category', function ($query) use ($value) {
                    $query->where('name', 'LIKE', '%' . $value . '%');
                });
        });
    }
}
