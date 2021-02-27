<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CompanySearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        return $query->select('companies.*')
            ->where('company_name', 'LIKE', '%' . $value . '%')
            ->orWhere('company_address', 'LIKE', '%' . $value . '%')
            ->orWhere('company_phone', 'LIKE', '%' . $value . '%')
            ->orWhere('company_author', 'LIKE', '%' . $value . '%')
            ->orWhere('company_web_site', 'LIKE', '%' . $value . '%');
    }
}
