<?php

namespace InetStudio\ACL\Users\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract;

/**
 * Class LoginRequest.
 */
class LoginRequest extends FormRequest implements LoginRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле «E-mail» обязательно для заполнения.',
            'email.email' => 'Поле «E-mail» содержит значение в некорректном формате.',

            'password.required' => 'Поле «Пароль» обязательно для заполнения.',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
