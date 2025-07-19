<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    
        $request->session()->regenerate();
    
        $user = Auth::user();
    
        // 🎯 Role-based redirection logic
        switch ($user->role) {
            case 'admin':
                return redirect()->route('dashboard'); // admin dashboard
            case 'planner':
            case 'poseur':
                return redirect()->route('rdv.calendar'); // calendrier
            case 'comptable':
                return redirect()->route('comptable.dashboard'); // custom dashboard
            case 'commercial':
                return redirect()->route('commercial.dashboard'); // custom dashboard
            case 'client_service':
            case 'client_limited':
                return redirect()->route('emails.inbox');
            case 'superadmin':
                return redirect()->route('dashboard'); // email inbox
            default:
                return redirect()->route('dashboard'); // fallback
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
