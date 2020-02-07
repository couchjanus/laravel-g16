<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Project</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.index") }}" class="nav-link">
                        <p>
                            <i class="fas fa-tachometer-alt">
                            </i>
                            <span>Dashboard</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.users.index") }}">
                        <i class="fas fa-users"></i>
                        <p>
                            <span>Users</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.categories.index") }}" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>
                            <span>Categories</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>