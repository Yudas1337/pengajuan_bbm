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
    <li
        class="sidebar-item {{ request()->routeIs('submissions.*') || request()->routeIs('submission.createForm') ? 'active' : '' }}">
        <a data-bs-target="#submissions" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Data
                Pengajuan</span>
        </a>
        <ul id="submissions"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('submissions.*') || request()->routeIs('submission.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li
                class="sidebar-item {{ request()->routeIs('submissions.create') || request()->routeIs('submission.createForm') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('submissions.create') }}">Tambah Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('submissions.index') || request()->routeIs('submissions.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('submissions.index') }}">List
                    Data</a>
            </li>
            @can('validate-letter-of-recommendation')
                <li class="sidebar-item {{ request()->routeIs('submission.verified') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('submission.verified') }}">Terverifikasi</a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('submission.unverified') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('submission.unverified') }}">Belum Diverifikasi</a>
                </li>
            @endcan
            @can('restore-letter-of-recommendation')
                <li
                    class="sidebar-item {{ request()->routeIs('submission.trashed') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('submission.trashed') }}">Riwayat Penghapusan</a>
                </li>
            @endcan
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
            <li class="sidebar-item {{ request()->routeIs('stations.create') ? 'active' : '' }}"><a class="sidebar-link"
                                                                                                    href="{{ route('stations.create') }}">Tambah
                    Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('stations.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('stations.index') }}">List
                    Data</a>
            </li>
        </ul>
    </li>
@endcan
@can('create-receiver')
    <li class="sidebar-header">
        Menu Penerima Bantuan
    </li>

    <li class="sidebar-item {{ request()->routeIs('receivers.*') ? 'active' : '' }}">
        <a data-bs-target="#receivers" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle me-2 fas fa-fw fa-users"></i> <span class="align-middle">
                Data Penerima Bantuan</span>
        </a>
        <ul id="receivers"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('receivers.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('receivers.create') ? 'active' : '' }}"><a
                    class="sidebar-link"
                    href="{{ route('receivers.create') }}">Tambah Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('receivers.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('receivers.index') }}">List
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
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('users.*') || request()->routeIs('user.inactive') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('users.create') ? 'active' : '' }}"><a class="sidebar-link"
                                                                                                 href="{{ route('users.create') }}">Tambah
                    Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('users.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('users.index') }}">Pengguna Aktif</a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('user.inactive') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('user.inactive') }}">Pengguna Nonaktif</a>
            </li>
        </ul>
    </li>
@endcan
