<?php

namespace App\Repositories\Note;

use App\Http\Filters\NoteSearchFilter;
use App\Models\Note;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NoteRepository implements NoteRepositoryInterface
{
    public $model;

    public function __construct(Note $note)
    {
        $this->model = $note;
    }

    public function get(Request $request)
    {
        $paginate = $request->has('paginate') ? $request->paginate : 5;
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                AllowedFilter::custom('noteSearch', new NoteSearchFilter()),
            ])->with('storage')->orderByDesc('created_at')
            ->paginate($paginate);
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
