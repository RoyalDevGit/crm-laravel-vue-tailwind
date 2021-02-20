<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PasswordChangeRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChange extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PasswordChangeRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return response()->json(['result' => 1, 'status' => 'success','message' => 'Şifreniz başarılı bir şekilde güncellenmiştir.']);
        } else {
            return response()->json(['result' => 0, 'status' => 'error','message' => 'Şifreniz eski şifreniz ile uyuşmuyor.']);
        }
    }
}
