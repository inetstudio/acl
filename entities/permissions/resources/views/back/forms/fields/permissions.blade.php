@inject('permissionsService', 'InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract')

@php
    $item = $value;
    $values = (old('permissions')) ? $permissionsService->getItemById(old('permissions'))->pluck('id')->toArray() : $item->permissions()->pluck('id')->toArray();

    $allPermissions = $permissionsService->getModel()->get()->toArray();

    $preparedPermissions = [];

    foreach ($allPermissions as $permission) {
        $preparedPermissions[$permission['package'] ?? ''][$permission['scope'] ?? ''][] = $permission;
    }

    ksort($preparedPermissions);
@endphp

@foreach ($preparedPermissions as $package => $scopes)
    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-bold"> <input type="checkbox" value="{{ mb_strtoupper($package) }}" name="permissions[]"> {{ mb_strtoupper($package) }}</label>

        @foreach ($scopes as $scope => $permissions)
            <div class="col-sm-2">
                <div><label class="font-bold"> <input type="checkbox" value="{{ $package.'.'.$scope }}" name="permissions[]"> {{ ucfirst($scope) }}</label></div>
                @foreach ($permissions as $permission)
                    <div><label> <input type="checkbox" value="{{ $permission['id'] }}" name="permissions[]" {{ (in_array($permission['id'], $values)) ? 'checked' : '' }}> {{ $permission['display_name'] ?? $permission['name'] }}</label></div>
                @endforeach
            </div>
        @endforeach
    </div>
    <hr>
@endforeach
