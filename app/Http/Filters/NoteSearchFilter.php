<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class NoteSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        return $query->select('notes.*')
            ->where('title', 'LIKE', '%' . $value . '%')
            ->orWhere('content', 'LIKE', '%' . $value . '%');
    }
}
