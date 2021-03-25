<?php

namespace App\Repositories\Mod;

use App\Models\Mod;

class ModRepository implements ModRepositoryInterface
{
    public $model;

    public function __construct(Mod $mod)
    {
        $this->model = $mod;
    }

    public function all()
    {
        return $this->model->all();
    }
}
