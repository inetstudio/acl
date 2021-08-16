@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование пользователя' : 'Создание пользователя';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.acl.users::back.partials.breadcrumbs.form')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <a class="btn btn-sm btn-white" href="{{ route('back.acl.users.index') }}">
                    <i class="fa fa-arrow-left"></i> Вернуться назад
                </a>
            </div>
        </div>

        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.acl.users.store') : route('back.acl.users.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data']) !!}

            @if ($item->id)
                {{ method_field('PUT') }}
            @endif

            {!! Form::hidden('user_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

            {!! Form::hidden('user_type', get_class($item), ['id' => 'object-type']) !!}

            <div class="ibox">
                <div class="ibox-title">
                    {!! Form::buttons('', '', ['back' => 'back.acl.users.index']) !!}
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-group float-e-margins" id="mainAccordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                                        </h5>
                                    </div>
                                    <div id="collapseMain" class="collapse show" aria-expanded="true">
                                        <div class="panel-body">

                                            {!! Form::string('name', $item->name, [
                                                'label' => [
                                                    'title' => 'Имя',
                                                ],
                                            ]) !!}

                                            {!! Form::string('email', $item->email, [
                                                'label' => [
                                                    'title' => 'Email',
                                                ],
                                            ]) !!}

                                            {!! Form::passwords('password', '', [
                                                'label' => [
                                                    'title' => 'Пароль',
                                                ],
                                                'fields' => [
                                                    [
                                                        'class' => 'form-control m-b-xs',
                                                        'placeholder' => 'Введите пароль',
                                                    ],
                                                    [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Повторите пароль',
                                                    ],
                                                ],
                                            ]) !!}

                                            {!! Form::string('api_token', $item->api_token, [
                                                'label' => [
                                                    'title' => 'API Токен',
                                                ],
                                            ]) !!}

                                            {!! Form::hidden('activated', 0) !!}
                                            {!! Form::checks('activated', $item['activated'], [
                                                'label' => [
                                                    'title' => 'Активирован',
                                                ],
                                                'checks' => [
                                                    [
                                                        'value' => 1,
                                                    ],
                                                ],
                                            ]) !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseAccess" aria-expanded="true">Доступ</a>
                                        </h5>
                                    </div>
                                    <div id="collapseAccess" class="collapse" aria-expanded="true">
                                        <div class="panel-body">

                                            {!! Form::roles('', $item) !!}

                                            {!! Form::permissions('', $item) !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-footer">
                    {!! Form::buttons('', '', ['back' => 'back.acl.users.index']) !!}
                </div>
            </div>

        {!! Form::close()!!}

    </div>
@endsection
