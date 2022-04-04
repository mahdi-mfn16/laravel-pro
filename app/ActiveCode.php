<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    protected $fillable = [
        'user_id' , 'code' , 'expired_at'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($query , $user)
    {
        // if($code = $this->checkExistLiveCode($user)){

        //     $code = $code->code;

        // }else{

            
        // }

        $user->active_codes()->delete();
        $code = mt_rand(100000 , 999999);
        // while($this->checkExistCode($user , $code)){
        //     $code = mt_rand(100000 , 999999);
        // }
            
        $user->active_codes()->create([
            'code'=>$code,
            'expired_at'=>now()->addMinutes(10)
        ]);
        
        return $code;

    }

    private function checkExistCode($user , $code)
    {
            return !! $user->active_codes()->where('code', $code)->first();
    }

    private function checkExistLiveCode($user)
    {
            return $user->active_codes()->where('expired_at' , '>' , now())->first();
    }


    public function scopeVerifyCode($query , $user , $code)
    {
        
        $status = !! $user->active_codes()->where('code' , $code)->where('expired_at' , '>' , now())->first();
        if($status){
            $user->active_codes()->delete();
        }
        return $status;
    }
}

