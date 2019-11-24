@inject('usersService', 'InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract')

@php
    $item = $value;
    $items = $usersService->getItemById(old('user_id') ? old('user_id') : (int) $item->user_id, [], false);
    $values = ($items) ? $items->pluck('email', 'id')->toArray() : [];
@endphp

{!! Form::dropdown('user_id', $item->user_id, [
    'label' => [
        'title' => 'Пользователь',
    ],
    'field' => [
        'class' => 'select2-drop form-control',
        'data-placeholder' => 'Выберите пользователя',
        'style' => 'width: 100%',
        'data-source' => route('back.acl.users.utility.suggestions'),
        'data-allow-clear' => 'true',
    ],
    'options' => [
        'values' => $values,
    ],
]) !!}
