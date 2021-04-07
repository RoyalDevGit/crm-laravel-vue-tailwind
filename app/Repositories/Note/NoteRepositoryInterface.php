<?php

namespace App\Repositories\Note;


use Illuminate\Http\Request;

interface NoteRepositoryInterface {

    public function all();
    public function get(Request $request);
    public function create($data);
    public function find($id);
    public function destroy($id);
}
