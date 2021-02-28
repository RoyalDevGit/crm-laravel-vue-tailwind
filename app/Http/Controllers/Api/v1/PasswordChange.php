<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PasswordChangeRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChange extends Controller
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


    public function __invoke(PasswordChangeRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        $user = $this->userRepository->find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return Response::json(['result' => 1, 'status' => 'success','message' => 'Şifreniz başarılı bir şekilde güncellenmiştir.'],200);
        } else {
            return Response::json(['result' => 0, 'status' => 'error','message' => 'Şifreniz eski şifreniz ile uyuşmuyor.'],500);
        }
    }
}
