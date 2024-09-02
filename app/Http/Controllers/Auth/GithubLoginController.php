<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class GithubLoginController extends Controller
{
    public function redirectToGithub() {
        return Socialite::driver('github')->redirect();
    }

    public function callbackToGithub() {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => Hash::make(rand(100000,999999)),
            'github_token' => $githubUser->token,
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
