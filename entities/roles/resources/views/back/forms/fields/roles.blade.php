@inject('rolesService', 'InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract')

@php
    $item = $value;
@endphp

{!! Form::dropdown('roles[]', $item->roles()->pluck('id')->toArray(), [
    'label' => [
        'title' => $attributes['label'] ?? 'Роли',
    ],
    'field' => [
        'class' => 'select2-drop form-control',
        'data-placeholder' => $attributes['placeholder'] ?? 'Выберите роли',
        'style' => 'width: 100%',
        'multiple' => 'multiple',
        'data-source' => route('back.acl.roles.utility.suggestions'),
        'data-exclude' => isset($attributes['exclude']) ? implode('|', $attributes['exclude']) : '',
    ],
    'options' => [
        'values' => (old('roles')) ? $rolesService->getItemById(old('roles'), true)->pluck('display_name', 'id')->toArray() : $item->roles()->pluck('display_name', 'id')->toArray(),
    ],
]) !!}
