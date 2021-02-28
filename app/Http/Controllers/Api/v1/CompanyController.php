<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\CustomerType\CustomerTypeRepositoryInterface;
use App\Repositories\SizeCode\SizeCodeRepositoryInterface;
use App\Repositories\Status\StatusRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public $companyRepository;
    public $customerTypeRepository;
    public $sizeCodeRepository;
    public $statusRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository,CustomerTypeRepositoryInterface $customerTypeRepository,SizeCodeRepositoryInterface $sizeCodeRepository,StatusRepositoryInterface $statusRepository)
    {
        $this->companyRepository= $companyRepository;
        $this->customerTypeRepository= $customerTypeRepository;
        $this->sizeCodeRepository= $sizeCodeRepository;
        $this->statusRepository= $statusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $company = $this->companyRepository->get($request);
        return CompanyResource::collection($company);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        return Response::json([
            'attributes' => [
                'size_code' => $this->sizeCodeRepository->all(),
                'customer_type' => $this->customerTypeRepository->all(),
                'status' => $this->statusRepository->all(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return JsonResponse
     */
    public function store(CompanyRequest $request): JsonResponse
    {
        $request->validated();

        $create = $this->companyRepository->create([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_main_country' => $request->company_main_country,
            'company_country' => $request->company_country,
            'company_city' => $request->company_city,
            'company_phone' => $request->company_phone,
            'company_author' => $request->company_author,
            'company_web_site' => $request->company_web_site,
            'tax_number' => $request->tax_number,
            'sector' => $request->sector,
            'field' => $request->field,
            'potential_fleet' => $request->potential_fleet,
            'customer_type_id' => $request->customer_type_id,
            'status_id' => $request->status_id,
            'user_id' => Auth::user()->id,
            'size_code_id' => $request->size_code_id,
            'is_active' => 1,
        ]);

        if ($create) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Yeni bir firma eklendi.'
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
    public function show(int $id): JsonResponse
    {
        $company = new CompanyResource($this->companyRepository->find($id));
        return Response::json([
            'data' => $company,
            'attributes' => [
                'size_code' => $this->sizeCodeRepository->all(),
                'customer_type' => $this->customerTypeRepository->all(),
                'status' => $this->statusRepository->all(),
                'user' => $company->user,
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CompanyRequest $request, int $id): JsonResponse
    {
        $request->validated();

        $company = $this->companyRepository->find($id);
        $company->fill([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_main_country' => $request->company_main_country,
            'company_country' => $request->company_country,
            'company_city' => $request->company_city,
            'company_phone' => $request->company_phone,
            'company_author' => $request->company_author,
            'company_web_site' => $request->company_web_site,
            'tax_number' => $request->tax_number,
            'sector' => $request->sector,
            'field' => $request->field,
            'potential_fleet' => $request->potential_fleet,
            'customer_type_id' => $request->customer_type_id,
            'status_id' => $request->status_id,
            'size_code_id' => $request->size_code_id,
        ])->save();

        if ($company) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Firma bilgileri düzenlendi.',
                'data' => new CompanyResource($company),
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
        $company = $this->companyRepository->destroy($id);
        if ($company) {
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
        $data = $this->companyRepository->find($id);
        $data->fill([
           'is_active' => $data->is_active == 1 ? 0 : 1
        ])->save();

        if ($data) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Firma bilgileri düzenlendi.',
                'data' => new CompanyResource($data),
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
