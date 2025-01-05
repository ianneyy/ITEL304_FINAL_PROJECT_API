<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info('Current Session Data: ', $request->session()->all());

        // Log the authenticated user for Admin or Student
        if (Auth::guard('student')->check()) {
            $user = Auth::guard('student')->user();  // Get the authenticated student user
            Log::info('Authenticated Student: ', ['id' => $user->id, 'name' => $user->name]);
        } elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();  // Get the authenticated admin user
            Log::info('Authenticated Admin: ', ['id' => $user->id, 'name' => $user->name]);
        } else {
            Log::info('No user is authenticated');
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
