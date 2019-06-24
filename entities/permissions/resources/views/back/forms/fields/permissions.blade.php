@inject('permissionsService', 'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract')

@php
    $item = $value;
@endphp

{!! Form::dropdown('permissions[]', $item->permissions()->pluck('id')->toArray(), [
    'label' => [
        'title' => $attributes['label'] ?? 'Права',
    ],
    'field' => [
        'class' => 'select2-drop form-control',
        'data-placeholder' => $attributes['placeholder'] ?? 'Выберите права',
        'style' => 'width: 100%',
        'multiple' => 'multiple',
        'data-source' => route('back.acl.permissions.getSuggestions'),
        'data-exclude' => isset($attributes['exclude']) ? implode('|', $attributes['exclude']) : '',
    ],
    'options' => [
        'values' => (old('permissions')) ? $permissionsService->getPermissionsByIDs(old('permissions'), true)->pluck('display_name', 'id')->toArray() : $item->permissions()->pluck('display_name', 'id')->toArray(),
    ],
]) !!}
