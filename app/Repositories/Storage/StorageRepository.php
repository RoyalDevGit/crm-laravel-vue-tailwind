<?php

namespace App\Repositories\Storage;

use App\Models\Storage;
use App\Repositories\Storage\StorageRepositoryInterface;

class StorageRepository implements StorageRepositoryInterface
{
    public $model;

    public function __construct(Storage $storage)
    {
        $this->model = $storage;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

}
