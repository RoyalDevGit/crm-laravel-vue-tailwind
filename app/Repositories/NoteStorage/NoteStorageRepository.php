<?php

namespace App\Repositories\NoteStorage;

use App\Http\Filters\NoteSearchFilter;
use App\Models\Note;
use App\Models\NoteGallery;
use App\Models\NoteStorage;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NoteStorageRepository implements NoteStorageRepositoryInterface
{
    public $model;

    public function __construct(NoteStorage $note)
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

    public function destroy($id): int
    {
        return $this->model->destroy($id);
    }
}
