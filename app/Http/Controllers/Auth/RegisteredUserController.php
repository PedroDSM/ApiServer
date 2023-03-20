<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Exceptions\InvalidOrderException;
use Illuminate\View\View;
use Mail;
use Illuminate\Support\Str;
use App\Mail\verification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code_verification' => Crypt::encryptString(Str::random(5)),
            'code_values' => Crypt::encryptString(Str::random(5)),
        ]);

        $mailData = [
            'title' => 'Codigo de Verificación',
            'body' => 'Da click en el siguiente link para obtener tu codigo de verificación',
        ];

        $url = URL::temporarySignedRoute('verification_code_movil', now()->addMinutes(30), ['user' => $user->id]);

        Mail::to($user->email)->send(new verification($mailData,$user,$url));

            Auth::login($user);
            event(new Registered($user));

            return redirect()->route('verification_code');
    }

    public function find_user(Request $request){
            $user = User::find($request->id);
            if ($user != null){
                return response()->json(['user'=>$user],200);
            }
            else{
                return response()->json(['message'=>'Error No Existe El Usuario'],401);
            }
    }

    public function verification_code (Request $request){
        $request->validate([
            'code_verification' => ['required', 'string'],
        ]);

        $usrs = User::all();
        foreach( $usrs as $usr){
            if(Crypt::decryptstring($usr->code_verification) == $request->code_verification){
                $code2 = Crypt::decryptstring($usr->code_values);
                return response()->json(['message'=>'Codigo Ingresado Correctamente', 'Token'=>$code2],200);
            } 
        }
        return response()->json(['message'=>'Token Invalido'],401);
    }

    public function codigo_web (Request $request){
        $request->validate([
            'code_values' => ['required', 'string'],
        ]);

        $usrs = User::all();
        foreach( $usrs as $usr){
            if(Crypt::decryptstring($usr->code_values) == $request->code_values){
                return redirect()->route('dashboard');
            } 
        }
        return abort(401);
    }
}
