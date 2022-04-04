<?php

namespace App\Http\Controllers\Auth;

use App\ActiveCode;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    // use TwoVerifyAuthenticated;
    public function redirect()
    {

        return Socialite::driver('google')->redirect();

    }

    public function callback(Request $request)
    {
        $curr_user = Socialite::driver('google')->stateless()->user();

        $user = User::where('email' , $curr_user->email)->first();
        try{

            if($user){

                auth()->loginUsingId($user->id);
                
    
            }else{
    
                $new_user = User::create([
    
                    'name'=>$curr_user->name,
                    'email'=>$curr_user->email,
                    'password'=>bcrypt(Str::random(8))
                ]);
                auth()->loginUsingId($new_user->id);
                $user = $new_user;
    
            }
            
            // if ($response = $this->twoAuthenticated($request , $user)) {
            //     return $response;
            // }

            alert()->success('You are Logged in!', 'Success')->persistent('Close');

            return redirect('/home');
        

        }catch(Exception $e){

            alert()->error('Your Login is Failed!', 'Error');
            return redirect('/login');
        }
    }
    
    
}
