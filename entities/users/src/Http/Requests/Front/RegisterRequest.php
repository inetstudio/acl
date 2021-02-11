<?php

namespace InetStudio\ACL\Users\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\ACL\Passwords\Validation\Rules\StrongPassword;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract;

class RegisterRequest extends FormRequest implements RegisterRequestContract
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле «Имя» обязательно для заполнения.',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов.',

            'email.required' => 'Поле «E-mail» обязательно для заполнения.',
            'email.email' => 'Поле «E-mail» содержит значение в некорректном формате.',
            'email.max' => 'Поле «E-mail» не должно превышать 255 символов.',
            'email.unique' => 'Пользователь с таким «E-mail» уже существует.',

            'password.required' => 'Поле «Пароль» обязательно для заполнения.',
            'password.confirmed' => 'Введенные пароли не совпадают.',
            'password.min' => 'Поле «Пароль» должно содержать минимум 6 символов.',

            'policy-agree.required' => 'Обязательно для заполнения.',
        ];
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'policy-agree' => 'required',
        ];

        if (! config('acl.passwords.generate')) {
            $rules['password'] = [
                'required',
                'confirmed',
                new StrongPassword(),
            ];
        }

        return $rules;
    }
}
