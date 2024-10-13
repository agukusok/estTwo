<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'username' => 'required|string',
        ];
    }

    public function validateCredentials()
    {
        $credentials = $this->only('email', 'username');

        $user = User::where('email', $credentials['email'])
            ->where('username', $credentials['username'])
            ->first();

        if (!$user) {
            $this->merge(['error' => 'Неверные данные для входа.']);
            return false;
        }

        if ($user->is_blocked) {
            $this->merge(['error' => 'User is blocked']);
            return false;
        }

        return true;
    }
}
