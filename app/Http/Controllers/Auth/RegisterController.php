<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'is_blocked' => false,
        ]);

        Auth::login($user);

        $request->headers->set('User-Id', $user->id);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Регистрация успешна.',
                'redirect' => route('user.profile')
            ], 200);
        }

        return redirect()->route('user.profile')->with('message', 'Регистрация успешна.');
    }
}
