<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserRequest $request)
    {
        $user = User::find(Auth::user()->id);

        $user->fill([
            'name' => $request->name,
        ])->save();

        if($user){
            return response()->json(['result' => 1, 'status' => 'success','message' => 'Bilgileriniz başarılı bir şekilde güncellenmiştir.'],201);
        } else {
            return response()->json(['result' => 0, 'status' => 'error','message' => 'Sunucu hatası.'],500);
        }
    }
}
