<?php

namespace App\Repositories\NoteStorage;


use Illuminate\Http\Request;

interface NoteStorageRepositoryInterface {

    public function all();
    public function get(Request $request);
    public function create($data);
    public function find($id);
    public function destroy($id);
}
