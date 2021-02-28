<?php

namespace App\Repositories\CustomerType;

use App\Models\CustomerType;

class CustomerTypeRepository implements CustomerTypeRepositoryInterface
{
    public $model;

    public function __construct(CustomerType $customerType)
    {
        $this->model = $customerType;
    }

    public function all()
    {
        return $this->model->all();
    }
}
