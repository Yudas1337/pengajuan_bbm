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
@hasrole('administrator')
    <li class="sidebar-item {{ request()->routeIs('ships.*') || request()->routeIs('harbors.*') ? 'active' : '' }}">
        <a data-bs-target="#ships" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle me-2 fas fa-fw fa-ship"></i <span class="align-middle">Data
            Kapal</span>
        </a>
        <ul id="ships"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('ships.*') || request()->routeIs('harbors.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('ships.*') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('ships.index') }}">List Kapal</a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('harbors.*') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('harbors.index') }}">List Pelabuhan</a></li>
        </ul>
    </li>
@endhasrole
@can('create-shippings')
    <li class="sidebar-item {{ request()->routeIs('shippings.*') ? 'active' : '' }}">
        <a data-bs-target="#shippings" data-bs-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Data
                Pelayaran</span>
        </a>
        <ul id="shippings"
            class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('shippings.*') ? 'show' : '' }}"
            data-bs-parent="#sidebar">
            <li class="sidebar-item {{ request()->routeIs('shippings.create') ? 'active' : '' }}"><a class="sidebar-link"
                    href="{{ route('shippings.create') }}">Tambah data</a>
            </li>
            <li
                class="sidebar-item {{ request()->routeIs('shippings.index') || request()->routeIs('shippings.edit') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('shippings.index') }}">View
                    Data</a>
            </li>
            @can('generate-report')
                <li class="sidebar-item {{ request()->routeIs('shippings.printPdf') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('shippings.printPdf') }}">Buat Laporan</a>
                </li>
            @endcan
            @can('view-verify-shippings')
                <li class="sidebar-item {{ request()->routeIs('shippings.verified') ? 'active' : '' }}"><a
                        class="sidebar-link" href="{{ route('shippings.verified') }}">Terverifikasi</a></li>
                <li class="sidebar-item {{ request()->routeIs('shippings.unverified') ? 'active' : '' }}"><a
                        class="sidebar-link" href="{{ route('shippings.unverified') }}">Belum diverifikasi</a></li>
            @endcan
        </ul>
    </li>
@endcan
@can('create-employees')
    <li class="sidebar-header">
        Menu Pengguna
    </li>
    <li class="sidebar-item {{ request()->routeIs('employees.*') ? 'active' : '' }}">
        <a href="{{ route('employees.index') }}" class="sidebar-link">
            <i class="align-middle me-2 fas fa-fw fa-user"></i> <span class="align-middle">Data Pegawai</span>
        </a>
    </li>
@endcan()
