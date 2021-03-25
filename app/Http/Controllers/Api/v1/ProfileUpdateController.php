<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateController extends Controller
{

    public $userRepository;

    /**
     * Handle the incoming request.
     *
     * @param UserRepositoryInterface $userRepository
     */

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository= $userRepository;
    }

    public function __invoke(UserRequest $request): \Illuminate\Http\JsonResponse
    {

        $user = $this->userRepository->find(Auth::user()->id);

        $user->name = $request->name;
        $user->profile_image = $request->profile_image;
        $user->save();

        if($user){
            return Response::json(['result' => 1, 'status' => 'success','message' => 'Profil bilgileriniz güncellendi.','data' => $user],200);
        } else {
            return Response::json(['result' => 0, 'status' => 'error','message' => 'Sunucu hatası.'],500);
        }
    }
}
