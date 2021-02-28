<?php

namespace App\Repositories\Status;

use App\Models\Status;
use App\Repositories\Status\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    public $model;

    public function __construct(Status $status)
    {
        $this->model = $status;
    }

    public function all()
    {
        return $this->model->all();
    }
}
