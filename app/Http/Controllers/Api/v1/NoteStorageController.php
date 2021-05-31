<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Repositories\Note\NoteRepositoryInterface;
use App\Repositories\NoteStorage\NoteStorageRepositoryInterface;
use App\Repositories\Storage\StorageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;


class NoteStorageController extends Controller
{
    public $noteStorageRepository;
    public $noteRepository;
    public $storageRepository;

    public function __construct(NoteStorageRepositoryInterface $noteStorageRepository, NoteRepositoryInterface $noteRepository,StorageRepository $storageRepository)
    {
        $this->noteStorageRepository = $noteStorageRepository;
        $this->noteRepository = $noteRepository;
        $this->storageRepository = $storageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $note = $this->noteStorageRepository->get($request);
        return NoteResource::collection($note);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): \Illuminate\Http\Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): \Illuminate\Http\Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): \Illuminate\Http\Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): \Illuminate\Http\Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
         $storage = $this->storageRepository->find($id)->notes()->detach();
         $this->storageRepository->delete($id);

        if ($storage){
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Kayıt silindi.',
            ]);
        }
        else{
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası...',
            ]);
        }
    }
}
