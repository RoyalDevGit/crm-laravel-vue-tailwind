<?php

namespace App\Repositories\User;


interface UserRepositoryInterface {

    public function all();

    public function find($id);

}
