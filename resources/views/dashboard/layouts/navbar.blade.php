@php
    $notifications = auth()->user()->unreadNotifications->take(10);
$totalNotifications = count(auth()->user()->unreadNotifications);
@endphp
<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="position-relative">
            <i class="align-middle" data-feather="bell"></i>
            <span class="indicator">{{ $totalNotifications  }}</span>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
        <div class="dropdown-menu-header">
            {{ $totalNotifications }} Notifikasi terbaru
        </div>
        <div class="list-group">
            @if($totalNotifications > 0)
                @forelse ($notifications as $notification)
                    <a target="_blank"
                       href="{{ $notification->data['type'] == 'accepted' ? route('submission.verified_detail', $notification->data['id']) : route('submission.unverified_detail', $notification->data['id'])  }}"
                       class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-2">
                                @if($notification->data['type'] == 'accepted')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-check-circle align-middle me-2 text-success">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-alert-circle text-danger">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                @endif

                            </div>
                            <div class="col-10">
                                @if($notification->data['type'] == 'accepted')
                                    <div class="text-dark">Pengajuan telah disetujui!</div>
                                @else
                                    <div class="text-dark">Pengajuan anda ditolak!</div>
                                @endif

                                <div class="text-muted small mt-1">{{ $notification->data['message']  }}</div>
                                <div
                                    class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>Belum ada notifikasi</p>
                @endforelse
            @endif
        </div>
        @if($totalNotifications > 0)
            <div class="dropdown-menu-header">
                <a href="{{ route('notifications.markAsRead') }}"
                   onclick="return confirm('Apa anda yakin ingin menandai semua notifikasi?')">Tandai telah dibaca</a>
            </div>
        @endif

    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
        <i class="align-middle" data-feather="settings"></i>
    </a>

    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
        <img src="{{ asset('app-assets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded-circle me-1"
             alt="{{ auth()->user()->name }}"/> <span class="text-dark">{{ auth()->user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="align-middle me-1"
                                                                       data-feather="user"></i>
            Profile</a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button onclick="return confirm('Anda yakin ingin logout?')" class="dropdown-item" type="submit">Log
                out
            </button>
        </form>
    </div>
</li>
