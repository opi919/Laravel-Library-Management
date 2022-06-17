<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function verify(Request $request)
    {
        // request all with remember token
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            if (auth()->user()->status == 0 || auth()->user()->status == -1) {
                auth()->logout();
                return redirect()->route('login')->with('status', 'Your account is not active yet. Please contact the administrator.');
            }
            return redirect()->route('dashboard');
        }
    }
}
