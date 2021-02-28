<?php

namespace App\Repositories\Company;

use Illuminate\Http\Request;

interface CompanyRepositoryInterface {

    public function get(Request $request);
    public function create($data);
    public function find($id);
    public function destroy($id);

}
