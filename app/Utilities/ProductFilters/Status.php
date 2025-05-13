<?php

namespace App\Utilities\ProductFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class Status extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('status', $value);
    }
}
