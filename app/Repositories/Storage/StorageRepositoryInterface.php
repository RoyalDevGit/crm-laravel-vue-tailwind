<?php

namespace App\Repositories\Storage;


interface StorageRepositoryInterface {

    public function create($data);
    public function destroy($id);
    public function find($id);
    public function delete($id);
}
