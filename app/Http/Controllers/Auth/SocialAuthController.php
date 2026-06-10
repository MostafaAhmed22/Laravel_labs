<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $githubUser = Socialite::driver('github')->user();
       //  dd($githubUser);
        $user = User::where("email", $githubUser->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $githubUser->getName(),
                'email' => $githubUser->getEmail(),
                'github_id' => $githubUser->getId(),
                'avatar' => $githubUser->getAvatar(),
                'password' => encrypt('password')
            ]);
        }
        Auth::login($user);
        return redirect(route('dashboard'));
    }
}
