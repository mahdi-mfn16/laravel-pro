<?php

namespace App\Http\Controllers\Auth;

use App\ActiveCode;
use Illuminate\Http\Request;

trait TwoVerifyAuthenticated
{
    public function twoAuthenticated(Request $request , $user)
    {
        if($user->twoVerifyIsEnable()){
            
            auth()->logout();
            $request->session()->flash('auth' , [
                'user_id'=>$user->id,
                'remember'=>$request->has('remember')
            ]);

            if($user->two_verify_type == 'sms'){

                $code = ActiveCode::generateCode($user);
                //send sms
                


                return redirect(route('token-verify'));
            }
        }

        return false;
    }
}
