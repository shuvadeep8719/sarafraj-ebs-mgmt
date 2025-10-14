<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Throwable;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);


            // Debug: Check if user exists with this username
            $user = User::where('username', $credentials['username'])->first();
            Log::info('User found by username: ' . ($user ? 'Yes - ID: ' . $user->id : 'No'));


            if (Auth::attempt($credentials)) {

                // Debug session before regeneration
                Log::info('Session ID before regeneration: ' . session()->getId());
                Log::info('Auth check after attempt: ' . (Auth::check() ? 'true' : 'false'));
                Log::info('Auth user after attempt: ' . (Auth::user() ? Auth::user()->username : 'null'));

                $request->session()->regenerate(); // prevent session fixation

                // Debug session after regeneration
                Log::info('Session ID after regeneration: ' . session()->getId());
                Log::info('Auth check after regeneration: ' . (Auth::check() ? 'true' : 'false'));

                return redirect()->intended('dashboard');

            }

            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ])->onlyInput('username');

        } catch (Throwable $e) {
            Log::error('Login failed: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Something went wrong during login. Please try again later.');
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('success', 'You have been logged out.');
        } catch (Throwable $e) {
            Log::error('Logout failed: '.$e->getMessage());

            return redirect()->route('dashboard')
                ->with('error', 'Could not log you out properly. Please try again.');
        }
    }
}
