<?php

namespace InetStudio\ACL\Roles\Providers;

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
        FormBuilder::component('roles', 'admin.module.acl.roles::back.forms.fields.roles', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
