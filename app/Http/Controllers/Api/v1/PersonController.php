<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PersonRequest;
use App\Http\Resources\PersonResource;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Mod\ModRepositoryInterface;
use App\Repositories\Person\PersonRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PersonController extends Controller
{
    public $personRepository;
    public $modRepository;
    public $companyRepository;

    public function __construct(PersonRepositoryInterface $personRepository,ModRepositoryInterface $modRepository,CompanyRepositoryInterface  $companyRepository)
    {
        $this->personRepository= $personRepository;
        $this->modRepository= $modRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $person = $this->personRepository->get($request);
        return PersonResource::collection($person);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create() :JsonResponse
    {
        return Response::json([
            'attributes' => [
                'mod' => $this->modRepository->all(),
                'gender' => [
                    'Erkek',
                    'Kadın',
                ],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PersonRequest $request
     * @return JsonResponse
     */
    public function store(PersonRequest $request) : JsonResponse
    {
        $request->validated();

        $create = $this->personRepository->create([
            'person_first_name' => $request->person_first_name,
            'person_last_name' => $request->person_last_name,
            'person_gender' => $request->person_gender,
            'person_title' => $request->person_title,
            'person_department' => $request->person_department,
            'person_email' => $request->person_email,
            'person_phone' => $request->person_phone,
            'person_phone2' => $request->person_phone2,
            'preferred_contact' => $request->preferred_contact,
            'skype' => $request->skype,
            'social_media' => $request->social_media,
            'lead_source' => $request->lead_source,
            'address' => $request->address,
            'companies_id' => $request->companies,
            'user_id' => Auth::user()->id,
            'mod_id' => $request->mod,
            'person_countries' => $request->person_countries,
            'person_cities' => $request->person_cities,
            'person_district' => $request->person_district,
            'is_active' => 1,
        ]);

        if ($create) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Yeni bir kişi eklendi.'
            ], 200);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası..'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id):JsonResponse
    {
        $person = new PersonResource($this->personRepository->find($id));
        return Response::json([
            'data' => $person,
            'attributes' => [
                'mod' => $this->modRepository->all(),
                'company' => $this->companyRepository->all(),
                'gender' => [
                    'Erkek',
                    'Kadın',
                ],
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id):JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PersonRequest $request, int $id):JsonResponse
    {
        $request->validated();

        // Find and update
        $person = $this->personRepository->find($id);

        $person->fill([
            'person_first_name' => $request->person_first_name,
            'person_last_name' => $request->person_last_name,
            'person_gender' => $request->person_gender,
            'person_title' => $request->person_title,
            'person_department' => $request->person_department,
            'person_email' => $request->person_email,
            'person_phone' => $request->person_phone,
            'person_phone2' => $request->person_phone2,
            'preferred_contact' => $request->preferred_contact,
            'skype' => $request->skype,
            'social_media' => $request->social_media,
            'lead_source' => $request->lead_source,
            'address' => $request->address,
            'companies_id' => $request->companies_id,
            'user_id' => Auth::user()->id,
            'mod_id' => $request->mod_id,
            'person_countries' => $request->person_countries,
            'person_cities' => $request->person_cities,
            'person_district' => $request->person_district,
            'is_active' => 1,
        ])->save();

        if ($person) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Kişi bilgileri düzenlendi.',
                'data' => new PersonResource($person),
            ], 200);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası.',
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
    public function destroy(int $id) :JsonResponse
    {
        $person = $this->personRepository->destroy($id);
        if ($person) {
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
    public function active($id): JsonResponse
    {
        $data = $this->personRepository->find($id);
        $data->fill([
            'is_active' => $data->is_active == 1 ? 0 : 1
        ])->save();

        if ($data) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Firma bilgileri düzenlendi.',
                'data' => new PersonResource($data),
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
