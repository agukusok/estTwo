<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|regex:/^[a-zA-Z]+$/|unique:users,username',
            'name' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Этот email уже зарегистрирован.',
            'username.required' => 'Имя пользователя обязательно для заполнения.',
            'username.regex' => 'Имя пользователя может содержать только латинские буквы.',
            'username.unique' => 'Это имя пользователя уже занято.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Имя не может превышать 255 символов.',
        ];
    }
}
