<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if (auth()->check()) {
            if (auth()->user()->hasRole('superadmin')) {
                return '/';
            } elseif (auth()->user()->hasRole('admin')) {
                return '/';
            } elseif (auth()->user()->hasRole('comptable')) {
                return '/factures';
            }
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Reset password logic...

        // Your custom redirect after password reset
        return redirect()->route('clients.index')->with('success', 'Password updated successfully.');
    }
}
