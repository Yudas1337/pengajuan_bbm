<li class="sidebar-header">
    Home
</li>
<li class="sidebar-item {{ request()->routeIs('dashboard.home') ? 'active' : '' }}">
    <a href="{{ route('dashboard.home') }}" class="sidebar-link">
        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboards</span>
    </a>
</li>

<li class="sidebar-header">
    Menu Utama
</li>
@can('submit-letter-of-recommendation')
    <li class="sidebar-item {{ request()->routeIs('submissions.*') ? 'active' : '' }}">
        <a data-bs-target="#shippings" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Data
                Pengajuan</span>
        </a>
        <ul id="shippings"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('submissions.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('submissions.create') ? 'active' : '' }}"><a
                    class="sidebar-link"
                    href="{{ route('submissions.create') }}">Tambah Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('submissions.index') || request()->routeIs('submissions.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('submissions.index') }}">List
                    Data</a>
            </li>
        </ul>
    </li>
@endcan

@can('create-station')

    <li class="sidebar-header">
        Menu SPBU
    </li>

    <li class="sidebar-item {{ request()->routeIs('stations.*') ? 'active' : '' }}">
        <a data-bs-target="#stations" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle me-2 fas fa-fw fa-gas-pump"></i> <span class="align-middle">
                Data SPBU</span>
        </a>
        <ul id="stations"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('stations.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('stations.create') ? 'active' : '' }}"><a
                    class="sidebar-link"
                    href="{{ route('stations.create') }}">Tambah Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('stations.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('stations.index') }}">List
                    Data</a>
            </li>
        </ul>
    </li>
@endcan

@can('create-user')

    <li class="sidebar-header">
        Menu Pengguna
    </li>

    <li class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle me-2 fas fa-fw fa-user"></i> <span class="align-middle">
                Data Pengguna</span>
        </a>
        <ul id="users"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('users.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('users.create') ? 'active' : '' }}"><a
                    class="sidebar-link"
                    href="{{ route('users.create') }}">Tambah Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('users.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('users.index') }}">List
                    Data</a>
            </li>
        </ul>
    </li>
@endcan
