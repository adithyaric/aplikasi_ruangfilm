<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image"><br>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p>Festival Film Horor 2026</p>
            </div>
        </div>

        @if (Auth::user()->role == 'admin')
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}"><i class="fa fa-film"></i> <span>Kategori Film</span></a>
            </li>
            <li class="{{ request()->routeIs('film.*') ? 'active' : '' }}">
                <a href="{{ route('film.index') }}"><i class="fa fa-file-text"></i> <span>Submission</span></a>
            </li>
            <li class="{{ request()->routeIs('users.index.author') || request()->routeIs('users.show') ? 'active' : '' }}">
                <a href="{{ route('users.index.author') }}"><i class="fa fa-group"></i> <span>Data Peserta</span></a>
            </li>
            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fa fa-user"></i> <span>Data Pengguna</span></a>
            </li>
            <li class="{{ request()->routeIs('settingIndex') ? 'active' : '' }}">
                <a href="{{ route('settingIndex') }}"><i class="fa fa-gear"></i> <span>Setting Submission</span></a>
            </li>
        </ul><!-- /.sidebar-menu -->
        @endif

        @if (Auth::user()->role == 'adminsub')
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ request()->routeIs('film.*') ? 'active' : '' }}">
                <a href="{{ route('film.index') }}"><i class="fa fa-file-text"></i> <span>Submission</span></a>
            </li>
            <li class="{{ request()->routeIs('users.index.author') || request()->routeIs('users.show') ? 'active' : '' }}">
                <a href="{{ route('users.index.author') }}"><i class="fa fa-group"></i> <span>Data Peserta</span></a>
            </li>
        </ul><!-- /.sidebar-menu -->
        @endif

        @if (Auth::user()->role == 'peserta')
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ request()->routeIs('user-detail.*') ? 'active' : '' }}">
                <a href="{{ route('user-detail.index') }}"><i class="fa fa-user"></i> <span>Biodata</span></a>
            </li>
            <li class="{{ request()->routeIs('film.*') ? 'active' : '' }}">
                <a href="{{ route('film.index') }}"><i class="fa fa-file-text"></i> <span>Submission</span></a>
            </li>
        </ul><!-- /.sidebar-menu -->
        @endif
    </section>
    <!-- /.sidebar -->
</aside>