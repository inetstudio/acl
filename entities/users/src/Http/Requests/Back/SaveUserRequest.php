<?php

namespace InetStudio\ACL\Users\Http\Requests\Back;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveUserRequestContract;

/**
 * Class SaveUserRequest.
 */
class SaveUserRequest extends FormRequest implements SaveUserRequestContract
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
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.string' => 'Поле «Имя» должно быть строкой',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',

            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.email' => 'Поле «Email» содержит некорректный почтовый адрес',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.unique' => 'Такой почтовый адрес уже существует',

            'password.required' => 'Поле «Пароль» обязательно для заполнения',
            'password.min' => 'Минимальный размер поля "Пароль" 6 символов',
            'password.confirmed' => 'Введенные пароли не совпадают',

            'roles_id.array' => 'Поле «Роли» должно быть массивом',

            'permissions_id.array' => 'Поле «Права» должно быть массивом',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$request->get('user_id'),
            'permissions_id' => 'nullable|array',
            'roles_id' => 'nullable|array',
            'password' => 'nullable|min:6|confirmed',
        ];

        if (! $request->filled('user_id')) {
            $rules['password'] .= '|required';
        }

        return $rules;
    }
}
