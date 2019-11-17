@inject('usersService', 'InetStudio\ACL\Users\Services\Back\ItemsServiceContract')

@php
    $registrations = $usersService->getItemsStatisticByActivation();
    $colors = $usersService->getActivationsColors();
    $titles = $usersService->getActivationsTitles();
@endphp

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <h2>Регистрации</h2>
        <ul class="todo-list m-t">
            @foreach ($registrations as $registration)
                <li>
                    <small class="label label-{{ $colors[$registration->activated] ?? 'info' }}">{{ $registration->total }}</small>
                    <span class="m-l-xs">{{ $titles[$registration->activated] ?? 'Не удалось определить статус' }}</span>
                </li>
            @endforeach
            <hr>
            <li>
                <small class="label label-default">{{ $registrations->sum('total') }}</small>
                <span class="m-l-xs">Всего</span>
            </li>
        </ul>
    </div>
</div>
