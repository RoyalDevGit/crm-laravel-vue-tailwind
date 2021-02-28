<?php

namespace App\Repositories\SizeCode;

use App\Models\SizeCode;

class SizeCodeRepository implements SizeCodeRepositoryInterface
{
    public $model;

    public function __construct(SizeCode $sizeCode)
    {
        $this->model = $sizeCode;
    }

    public function all()
    {
        return $this->model->all();
    }
}
