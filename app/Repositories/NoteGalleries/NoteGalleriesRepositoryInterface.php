<?php

namespace App\Repositories\NoteGalleries;


use Illuminate\Http\Request;

interface NoteGalleriesRepositoryInterface {

    public function all();
    public function get(Request $request);
    public function create($data);
    public function find($id);
    public function destroy($id);
}
