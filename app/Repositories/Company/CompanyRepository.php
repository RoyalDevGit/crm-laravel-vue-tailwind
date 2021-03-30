<?php

namespace App\Repositories\Company;

use App\Http\Filters\CompanySearchFilter;
use App\Models\Company;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyRepository implements CompanyRepositoryInterface
{
    public $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function get(Request $request)
    {
        $paginate = $request->has('paginate') ? $request->paginate : 5;
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('customer_type_id'),
                AllowedFilter::exact('size_code_id'),
                AllowedFilter::custom('companySearch', new CompanySearchFilter),
            ])->allowedSorts('id')
            ->paginate($paginate);
    }

    public function all(){
        return $this->model->all();
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
