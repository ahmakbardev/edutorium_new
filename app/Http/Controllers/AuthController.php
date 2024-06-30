<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        // Perform the logout
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page
        return redirect()->route('beranda')->with('status', 'Successfully logged out!');
    }
}
