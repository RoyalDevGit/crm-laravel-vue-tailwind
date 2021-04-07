<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Repositories\Note\NoteRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{

    public $noteRepository;
    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request) : AnonymousResourceCollection
    {
        $note = $this->noteRepository->get($request);
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
     * @param NoteRequest $request
     * @return JsonResponse
     */
    public function store(NoteRequest $request): JsonResponse
    {
        $request->validated();

        $create = $this->noteRepository->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
            'is_active' => 1,
        ]);

        if ($create) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Yeni bir not eklendi.',
                'data' => $create,
            ], 200);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası..',
                'data' => $create,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $company = new NoteResource($this->noteRepository->find($id));
        return Response::json([
            'data' => $company,
        ]);
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
     * @param NoteRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(NoteRequest $request, int $id): JsonResponse
    {
        $request->validated();

        $note = $this->noteRepository->find($id);
        $note->fill([
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'is_active' => $request->post('is_active')
        ])->save();

        if ($note) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Not bilgileri düzenlendi.',
                'data' => new NoteResource($note),
            ], 200);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası...',
                'data' => null,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $note = $this->noteRepository->destroy($id);
        if ($note) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Kayıt silindi.',
            ]);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu Hatası...',
            ]);
        }
    }

    public function active(int $id) :JsonResponse
    {
        $data = $this->noteRepository->find($id);
        $data->fill([
            'is_active' => $data->is_active == 1 ? 0 : 1
        ])->save();

        if ($data) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Not bilgileri düzenlendi.',
                'data' => new NoteResource($data),
            ], 200);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası...',
                'data' => null,
            ], 500);
        }
    }
}
