<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider){
        try {
            $user = Socialite::driver($provider)->user();
            $finduser = User::where('social_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social' => $provider,
                    'password' => Hash::make('my-google')
                ]);
                Auth::login($newUser);
            }
            return redirect()->route('welcome');

        } catch (Exception $th) {
            return redirect()->route('login')->with([
                'message' => 'Error while logging in.',
                'operationSuccessful' => $this->operationSuccessful,
            ]);
        }
    }
    
    
    
    
}
