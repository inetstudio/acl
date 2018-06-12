@inject('usersService', 'InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract')

@php
    $item = $value;
@endphp

{!! Form::dropdown('user_id', $item->user_id, [
    'label' => [
        'title' => 'Пользователь',
    ],
    'field' => [
        'class' => 'select2 form-control',
        'data-placeholder' => 'Выберите пользователя',
        'style' => 'width: 100%',
    ],
    'options' => [
        'values' => [null => ''] + $usersService->getAllUsers()->pluck('name', 'id')->toArray(),
    ],
]) !!}
