<?php

namespace App\Http\Controllers\PasswordReset;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPass extends Controller
{
    function showResetPage()
    {
        return view('auth.passwords.forgetPassword');
    }

    function resetPass(Request $request)
    {
     $request->validate([
         'email'=> 'required | email |  exists:users',
     ]);
     $token = Str::random(64);
     Mail::send('auth.passwords.resetTemplate', ['token' => $token], function ($message) use ($request) {
        $message->to($request->email);
        $message->subject("Reset your password");
     });
     return back()->with("message","We have sent you an reset link");
    }

    public function showPassword($token)
    {
        return view('auth.passwords.reset',['token'=> $token]);
    }

    public function submitResetPass(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required| string | min:6 |confirmed',
            'password_confirm' => 'required',
        ]);
        $updatePassword = DB::table('password_reset')
            ->where([
                'email'=>$request->email,
                'token'=>$request->token,
            ])
            ->first();
            if(!$updatePassword)
            {
                return back()->withInput()->with('error','Invalid token');
            }
            $user = User::where('email',$request->email)
            ->update(['password'=> Hash::make($request->password)]);
            DB::table('password_reset')->where(['email'=>$request->email])->delete();
            return redirect()->route('login')->with('message','Your password has been changed');

    }
}
