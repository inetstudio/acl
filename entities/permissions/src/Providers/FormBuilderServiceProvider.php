<?php

namespace InetStudio\ACL\Permissions\Providers;

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
        FormBuilder::component('permissions', 'admin.module.acl.permissions::back.forms.fields.permissions', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
