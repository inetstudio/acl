@inject('permissionsService', 'InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract')

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
        'data-source' => route('back.acl.permissions.utility.suggestions'),
        'data-exclude' => isset($attributes['exclude']) ? implode('|', $attributes['exclude']) : '',
    ],
    'options' => [
        'values' => (old('permissions')) ? $permissionsService->getItemById(old('permissions'), true)->pluck('display_name', 'id')->toArray() : $item->permissions()->pluck('display_name', 'id')->toArray(),
    ],
]) !!}
