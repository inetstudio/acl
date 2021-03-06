<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin | Вход</title>

        <link href="{{ asset(mix('admin/css/app.css', '/admin/')) }}" rel="stylesheet">
    </head>

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name"><i class="fa fa-sign-in-alt"></i></h1>
                </div>
                <form class="m-t" role="form" action="{{ url(route('back.acl.users.login.post')) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row @if(isset($errors) && $errors->has('email')) has-error @endif">
                        <input type="text" name="login" class="form-control" placeholder="Логин" required="">
                    </div>
                    <div class="form-group row @if(isset($errors) && $errors->has('password')) has-error @endif">
                        <input type="password" name="password" class="form-control" placeholder="Пароль" required="">
                    </div>
                    <div class="form-group row">
                        <div class="i-checks float-right m-b-sm">
                            <label> <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> <i></i> Запомнить меня </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary block full-width">Войти</button>
                </form>
            </div>
        </div>

        <script src="{{ asset(mix('admin/js/manifest.js', '/admin/')) }}"></script>
        <script src="{{ asset(mix('admin/js/vendor.js', '/admin/')) }}"></script>
        <script src="{{ asset(mix('admin/js/app.js', '/admin/')) }}"></script>

    </body>
</html>
