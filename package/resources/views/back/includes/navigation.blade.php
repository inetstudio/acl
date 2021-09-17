<li class="{{ isActiveRoute('back.acl.*', 'mm-active') }}">
    <a href="#" aria-expanded="false"><i class="fa fa-users"></i> <span class="nav-label">ACL </span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        @include('admin.module.acl.roles::back.includes.package_navigation')
        @include('admin.module.acl.permissions::back.includes.package_navigation')
        @include('admin.module.acl.users::back.includes.package_navigation')
    </ul>
</li>
