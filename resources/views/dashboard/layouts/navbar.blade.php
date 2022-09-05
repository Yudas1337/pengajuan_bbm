<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
        <i class="align-middle" data-feather="settings"></i>
    </a>

    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
        <img src="{{ asset('app-assets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded-circle me-1"
            alt="{{ auth()->user()->name }}" /> <span class="text-dark">{{ auth()->user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="align-middle me-1"
                data-feather="user"></i>
            Profile</a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button onclick="return confirm('Anda yakin ingin logout?')" class="dropdown-item" type="submit">Log
                out</button>
        </form>
    </div>
</li>
