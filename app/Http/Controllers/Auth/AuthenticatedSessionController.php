<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $user = auth()->user();
        activity()->enableLogging();

        activity()->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                'attributes' => $user->only(['name', 'email'])])
            ->inLog('User')
            ->createdAt(now())
            ->log('login');

        // For first time login
        if (is_null(Auth::user()->password_change_at)) {
            $token = Password::createToken(Auth::user());
            $email = Auth::user()->email;

            Auth::logout();

            return to_route('password.reset', [$token, 'email' => $email])->with('alert', 'auth.first-login');
        }

        $request->session()->regenerate();

        session()->flash('message', 'Logged In! Welcome back.');

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        activity()->enableLogging();

        activity()->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                'attributes' => $user->only(['name', 'email'])])
            ->inLog('User')
            ->createdAt(now())
            ->log('Logged Out');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
