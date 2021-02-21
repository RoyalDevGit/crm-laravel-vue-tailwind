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
    public function index()
    {
        return CompanyResource::collection(Company::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyRequest $request)
    {
        $request->validated();

        $create = Company::create([
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'company_author' => $request->company_author,
            'company_web_site' => $request->company_web_site,
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
     * @return CompanyResource
     */
    public function show($id): \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id) :  \Illuminate\Http\JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyRequest $request, $id)
    {
        $request->validated();

        $company = Company::find($id);
        $company->fill([
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'company_author' => $request->company_author,
            'company_web_site' => $request->company_web_site,
        ])->save();

        if($company){
            return response()->json([
                'result' => 1,
                'status' => 'succes',
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
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
