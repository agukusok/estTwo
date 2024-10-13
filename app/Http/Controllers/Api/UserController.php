<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function getUserInfo()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors('Пользователь не найден.');
        }

        return view('user.profile', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Пользователь не найден.'], 404);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update($request->validated());

        return response()->json([
            'message' => 'Данные успешно обновлены.',
            'redirect_to' => route('user.profile'),
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Пользователь не найден.'], 404);
        }

        DB::table('users')->where('id', $user->id)->delete();

        Auth::guard('web')->logout();

        return response()->json(['message' => 'Аккаунт успешно удален.', 'redirect' => '/']);
    }
}
