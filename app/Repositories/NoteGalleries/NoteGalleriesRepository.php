<?php

namespace App\Repositories\NoteGalleries;

use App\Http\Filters\NoteSearchFilter;
use App\Models\Note;
use App\Models\NoteGallery;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NoteGalleriesRepository implements NoteGalleriesRepositoryInterface
{
    public $model;

    public function __construct(NoteGallery $note)
    {
        $this->model = $note;
    }

    public function get(Request $request)
    {
        return $this->model->all();
    }

    public function all(){
        return $this->model->all();
    }

    public function create($data){
        return $this->model->create($data);
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function destroy($id){
        return $this->model->destroy($id);
    }
}
