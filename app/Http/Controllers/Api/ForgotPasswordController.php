<?php

namespace App\Http\Controllers\Api;

use App\Mail\apiforgotpassword;
use App\Model\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => -1
            ]);
        }
        $user = User::where('email', $request->input('email'))->first();
        if ((!$user) || ($user->role == 'ROLE_ADMIN') || ($user->role == 'ROLE_EMPLOYE')){
            return response()->json([
                'code' => 400
            ]);
        }
        $token = $this->broker()->createToken($user);
        $user->sendPasswordResetNotification($token);
        return response()->json([
            'code' => 1
        ]);
    }
}
