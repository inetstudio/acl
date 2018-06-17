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
        'data-source' => route('back.acl.users.getSuggestions'),
    ],
    'options' => [
        'values' => $usersService->getUsersByIDs(old('user_id') ? old('user_id') : (int) $item->user_id, true)->pluck('email', 'id')->toArray(),
    ],
]) !!}
