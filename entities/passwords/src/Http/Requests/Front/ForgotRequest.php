<?php

namespace InetStudio\ACL\Passwords\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotRequestContract;

/**
 * Class ForgotRequest.
 */
class ForgotRequest extends FormRequest implements ForgotRequestContract
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
        ];
    }
}
