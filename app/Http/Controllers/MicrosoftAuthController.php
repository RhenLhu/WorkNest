<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class MicrosoftAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        try {
            /** @var \SocialiteProviders\Microsoft\Provider $driver */
            $driver = Socialite::driver('microsoft');

            // Skip SSL check only during local development
            if (app()->environment('local')) {
                $driver->setHttpClient(new Client([
                    'verify' => false,
                ]));
            }

            $microsoftUser = $driver->user();

            $user = User::updateOrCreate(
                ['email' => $microsoftUser->getEmail()],
                [
                    'name' => $microsoftUser->getName() ?? $microsoftUser->getNickname(),
                    'microsoft_id' => $microsoftUser->getId(),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Microsoft authentication failed.');
        }
    }
}