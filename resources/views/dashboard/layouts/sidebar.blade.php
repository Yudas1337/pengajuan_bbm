@php use App\Helpers\UserHelper; @endphp
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
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('submissions.*') || request()->routeIs('submission.trashed') || request()->routeIs('submission.createForm') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li
                class="sidebar-item {{ request()->routeIs('submissions.create') || request()->routeIs('submission.createForm') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('submissions.create') }}">Tambah Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('submissions.index') || request()->routeIs('submissions.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('submissions.index') }}">Pengajuan Saya</a>
            </li>
            @can('restore-letter-of-recommendation')
                <li class="sidebar-item {{ request()->routeIs('submission.trashed') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('submission.trashed') }}">Riwayat Penghapusan</a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('validate-letter-of-recommendation')
    <li
        class="sidebar-item {{ request()->routeIs('submission.verified') || request()->routeIs('submission.unverified') ? 'active' : '' }}">
        <a data-bs-target="#verify-submissions" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="check-square"></i> <span
                class="align-middle">Validasi Pengajuan</span>
        </a>
        <ul id="verify-submissions"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('submission.verified') || request()->routeIs('submission.unverified') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            @can('validate-letter-of-recommendation')
                <li
                    class="sidebar-item {{ request()->routeIs('submission.verified') || request()->routeIs('submission.verified_detail') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('submission.verified') }}">Terverifikasi</a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('submission.unverified') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('submission.unverified') }}">Belum Diverifikasi</a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
@if(UserHelper::checkRolePenyuluh() || UserHelper::checkRoleTangkap() || UserHelper::checkRolePembudidaya())
    <li class="sidebar-header">
        Menu Master
    </li>
@endif

@can('create-station')
    <li class="sidebar-item {{ request()->routeIs('stations.*') ? 'active' : '' }}">
        <a data-bs-target="#stations" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle me-2 fas fa-fw fa-gas-pump"></i> <span class="align-middle">
                Data Stasiun</span>
        </a>
        <ul id="stations"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('stations.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('stations.create') ? 'active' : '' }}"><a class="sidebar-link"
                                                                                                    href="{{ route('stations.create') }}">Tambah
                    Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('stations.index') || request()->routeIs('stations.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('stations.index') }}">List
                    Data</a>
            </li>
        </ul>
    </li>
@endcan

@can('create-group')

    <li class="sidebar-item {{ request()->routeIs('groups.*') ? 'active' : '' }}">
        <a data-bs-target="#groups" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                Data Kelompok</span>
        </a>
        <ul id="groups"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('groups.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('groups.create') ? 'active' : '' }}"><a class="sidebar-link"
                                                                                                  href="{{ route('groups.create') }}">Tambah
                    Data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('groups.index') || request()->routeIs('users.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('groups.index') }}">List
                    Data</a>
            </li>
        </ul>
    </li>
@endcan

@can('create-receiver')
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

@can('history-transaction')
    <li class="sidebar-header">
        Menu Transaksi
    </li>
    <li class="sidebar-item {{ request()->routeIs('histories.index') ? 'active' : '' }}">
        <a href="{{ route('histories.index') }}" class="sidebar-link">
            <i class="align-middle me-2 fas fa-fw fa-credit-card"></i> <span
                class="align-middle">History Transaksi</span>
        </a>
    </li>
@endcan
