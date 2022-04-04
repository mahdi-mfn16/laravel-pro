<?php

namespace App\Http\Controllers\Auth;

use App\ActiveCode;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class TokenVerifyController extends Controller
{
    public function getTokenVerify(Request $request){

        if(! $request->session()->has('auth')){
            return redirect(route('login'));
        }
        $request->session()->reflash();
        return view('auth.token_verify');

    }

    public function postTokenVerify(Request $request){

        if(! $request->session()->has('auth')){
            return redirect(route('login'));
        }
        $code = $request->validate([
            'token'=>'required'
        ]);
        $user = User::findOrFail($request->session()->get('auth.user_id'));
        $status = ActiveCode::verifyCode($user , $code);
        if($status){
            auth()->loginUsingId($user->id, $request->session()->get('auth.remember'));
            alert()->success('' , 'Success');
            return redirect('/home');
        }

        alert()->error('' , 'Error');
        return redirect(route('login'));

    }
}
