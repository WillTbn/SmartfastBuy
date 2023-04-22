<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\ValidateRequest;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    use ValidateRequest;
    
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status == Password::RESET_LINK_SENT) {
            return $this->simpleAnswer('success', __($status), 201);
        }

        throw ValidationException::withMessages([
            
            'email' => [trans($status)],
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ],
        $this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        // return 'oi';

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return $this->simpleAnswer('success','Senha resetada com sucesso ! Faça login, com sua nova senha.', 200);
            // return response()->json(array('message' => 'Senha resetada com sucesso ! Faça login, com sua nova senha.'),200);
        }
        return response()->json(['error' => __($status)],500);
    }


}
