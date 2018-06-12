<?php

namespace InetStudio\ACL\Users\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

/**
 * Class FormBuilderServiceProvider.
 */
class FormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        FormBuilder::component('user', 'admin.module.acl.users::back.forms.fields.user', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
