<?php

namespace App\Http\Controllers;

use App\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use App\User;
use Dotenv\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('profile.index');

    }

    public function twoVerify()
    {
        return view('profile.two-verify');

    }

    public function postTwoVerify(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:off,sms',
            'mobile' => [
                'required_unless:type,off',
                 Rule::unique('users')->ignore(auth()->user()->id),
            ]
        ]);

        
       
        
        if($data['type'] === 'sms'){

            if($request->user()->mobile != $data['mobile']){

                $code = ActiveCode::generateCode($request->user());
                $request->session()->flash('mobile' , $data['mobile']);
                 
                $request->user()->notify(new ActiveCodeNotification($code , $data['mobile']));
                

                return redirect(route('phone-sms'));

            }else{
                $request->user()->update([
                    'two_verify_type' => $data['type']     
                ]);
            }
        }

        if($data['type'] === 'off'){
            $request->user()->update([
                'two_verify_type' => $data['type']
            ]); 
        }

        return back();

        

    }


    public function phoneSmsVerify(Request $request)
    {
        if(! $request->session()->has('mobile')){
            return redirect(route('two-verify'));
        }
        $request->session()->reflash();
        return view('profile.phone-sms-verify');
    }

    public function postPhoneSmsVerify(Request $request)
    {
        $token = $request->validate([
            'token'=>'required'
        ]);

        if(! $request->session()->has('mobile')){
            return redirect(route('two-verify'));
        }

        $status = ActiveCode::verifyCode($request->user() , $token);

        if($status){
            $request->user()->update([
                'two_verify_type'=>'sms',
                'mobile'=>$request->session()->get('mobile')
            ]);


            alert()->success('sms two authenticate is activate','Success');

        }else{
            alert()->error('sms two authenticate is not activate','Error');
        }

        return redirect(route('two-verify'));
    }
} 
