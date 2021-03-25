<?php

namespace App\Repositories\Person;

use App\Http\Filters\PersonSearchFilter;
use App\Models\Person;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PersonRepository implements PersonRepositoryInterface
{
    public $model;

    public function __construct(Person $person)
    {
        $this->model = $person;
    }

    public function get(Request $request)
    {
        $paginate = $request->has('paginate') ? $request->paginate : 5;
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('customer_type_id'),
                AllowedFilter::exact('size_code_id'),
                AllowedFilter::custom('personSearch', new PersonSearchFilter()),
            ])->allowedSorts('id')
            ->paginate($paginate);

    }

    public function create($data){
        return $this->model->create($data);
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function destroy($id){
        return $this->model->destroy($id);
    }
}
