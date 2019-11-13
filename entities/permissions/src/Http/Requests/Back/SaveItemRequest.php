<?php

namespace InetStudio\ACL\Permissions\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SaveItemRequestContract;

/**
 * Class SaveItemRequest.
 */
class SaveItemRequest extends FormRequest implements SaveItemRequestContract
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
            'display_name.required' => 'Поле «Название» обязательно для заполнения',
            'display_name.max' => 'Поле «Название» не должно превышать 255 символов',
            'description.max' => 'Поле «Описание» не должно превышать 255 символов',
            'name.required' => 'Поле «Алиас» обязательно для заполнения',
            'name.max' => 'Поле «Алиас» не должно превышать 255 символов',
            'name.unique' => 'Такое значение поля «Алиас» уже существует',
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
            'display_name' => 'required|max:255',
            'description' => 'max:255',
            'name' => 'required|max:255|unique:permissions,name,'.$this->get('permission_id'),
        ];
    }
}
