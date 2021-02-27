<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\CustomerType;
use App\Models\SizeCode;
use App\Models\Status;
use App\Http\Filters\CompanySearchFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $paginate = $request->has('paginate') ? $request->paginate : 5;

        $company = QueryBuilder::for(Company::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('customer_type_id'),
                AllowedFilter::exact('size_code_id'),
                AllowedFilter::custom('companySearch', new CompanySearchFilter),
            ])->allowedSorts('id')
            ->paginate($paginate);


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
                'size_code' => SizeCode::all(),
                'customer_type' => CustomerType::all(),
                'status' => Status::all(),
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

        $create = Company::create([
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
            return response()->json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Yeni bir firma eklendi.'
            ], 201);
        } else {
            return response()->json([
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
        $company = new CompanyResource(Company::find($id));
        return Response::json([
            'data' => $company,
            'attributes' => [
                'size_code' => SizeCode::all(),
                'customer_type' => CustomerType::all(),
                'status' => Status::all(),
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

        $company = Company::find($id);
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
            return response()->json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Firma bilgileri düzenlenmiştir.',
                'data' => new CompanyResource($company),
            ], 201);
        } else {
            return response()->json([
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
        $company = Company::destroy($id);
        if ($company) {
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Kayıt silme işlemi başarılı',
            ]);
        } else {
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu Hatası...',
            ]);
        }

    }
    public function active($id){
        $data = Company::find($id);
        $data->fill([
           'is_active' => $data->is_active == 1 ? 0 : 1
        ])->save();

        if ($data) {
            return response()->json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Firma bilgileri düzenlenmiştir.',
                'data' => new CompanyResource($data),
            ], 201);
        } else {
            return response()->json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası...',
                'data' => null,
            ], 500);
        }


    }
}
