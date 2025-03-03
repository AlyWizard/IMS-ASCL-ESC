<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\AllianceUser;

class AllianceAuthController extends Controller
{
    /**
     * Show the login form for Alliance users.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('alliance.login');
    }

    /**
     * Handle an authentication attempt for Alliance users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        
        // Debug log to check the attempted credentials
        \Log::info('Login attempt', ['username' => $credentials['username']]);
        
        // Attempt to authenticate with the alliance guard
        if (Auth::guard('alliance')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            
            // Redirect to Alliance dashboard on successful login
            return redirect()->intended(route('alliance.dashboard'));
        }
        
        // Return back with an error message if authentication fails
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('alliance')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}