<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CustomerTypeResource;
use App\Http\Resources\SizeCodeResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\CustomerType;
use App\Models\SizeCode;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Epigra\TrGeoZones\Models\City;
use Epigra\TrGeoZones\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create()
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
    public function store(CompanyRequest $request)
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
            ],201);
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
    public function show($id): JsonResponse
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
    public function edit($id) :  JsonResponse
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
    public function update(CompanyRequest $request, $id)
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

        if($company){
            return response()->json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Firma bilgileri düzenlenmiştir.',
                'data' => new CompanyResource($company),
            ],201);
        }
        else{
            return response()->json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu hatası...',
                'data' => null,
            ],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $company = Company::destroy($id);
        if ($company){
            return Response::json([
                'result' => 1,
                'status' => 'success',
                'message' => 'Kayıt silme işlemi başarılı',
            ]);
        }else{
            return Response::json([
                'result' => 0,
                'status' => 'error',
                'message' => 'Sunucu Hatası...',
            ]);
        }

    }
}
