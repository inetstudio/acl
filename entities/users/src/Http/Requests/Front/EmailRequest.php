<?php

namespace InetStudio\ACL\Users\Http\Requests\Front;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract;

/**
 * Class EmailRequest.
 */
class EmailRequest extends FormRequest implements EmailRequestContract
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
            'email.max' => 'Поле «E-mail» не должно превышать 255 символов.',
            'email.unique' => 'Пользователь с таким «E-mail» уже существует. Воспользуйтесь стандартной формой входа.',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        Session::reflash();

        return [
            'email' => 'required|email|max:255|unique:users,email',
        ];
    }
}
