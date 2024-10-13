<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
	public function showLoginForm()
	{
		return view('auth.login');
	}

	public function login(LoginRequest $request)
	{
		if (!$request->validateCredentials()) {
			if ($request->expectsJson()) {
				return response()->json([
					'message' => $request->input('error')
				], 401);
			}

			return redirect()->route('login')->withErrors([
				'error' => $request->input('error')
			]);
		}

		$user = User::where('email', $request->email)->where('username', $request->username)->first();
		Auth::login($user);

		if ($request->expectsJson()) {
			return response()->json([
				'message' => 'Успешно авторизован.',
				'redirect' => route('user.profile')
			], 200);
		}

		return redirect()->route('user.profile')->with('message', 'Успешно авторизован.');
	}

	public function logout(Request $request)
	{
		if ($request->user()) {
			Auth::logout();

			if ($request->expectsJson()) {
				return response()->json([
					'message' => 'Вы успешно вышли из системы.',
					'redirect' => route('login')
				], 200);
			}

			return redirect()->route('login')->with('message', 'Вы успешно вышли из системы.');
		}

		if ($request->expectsJson()) {
			return response()->json([
				'message' => 'Вы не авторизованы.'
			], 401);
		}
		return redirect()->route('login')->withErrors([
			'error' => 'Вы не авторизованы.'
		]);
	}
}
