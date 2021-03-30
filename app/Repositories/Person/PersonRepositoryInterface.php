<?php

namespace App\Repositories\Person;

use Illuminate\Http\Request;

interface PersonRepositoryInterface {

    public function get(Request $request);
    public function create($data);
    public function find($id);
    public function update($data);
    public function destroy($id);
}
