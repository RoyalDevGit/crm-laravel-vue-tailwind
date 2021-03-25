<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PersonSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        return $query->select('people.*')
            ->where('person_first_name', 'LIKE', '%' . $value . '%')
            ->orWhere('person_last_name', 'LIKE', '%' . $value . '%')
            ->orWhere('person_department', 'LIKE', '%' . $value . '%')
            ->orWhere('person_email', 'LIKE', '%' . $value . '%')
            ->orWhere('person_phone', 'LIKE', '%' . $value . '%');
    }
}
