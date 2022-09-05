@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Settings</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action" href="{{ route('user.profile') }}" role="tab"
                            aria-selected="true">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action active"
                            href="{{ route('user.showPasswordForm') }}" role="tab" aria-selected="false"
                            tabindex="-1">
                            Password
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="password" role="tabpanel">
                        @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    <strong>Sukses!</strong> {{ Session::get('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>
                                <form method="POST" action="{{ route('user.change-password') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputPasswordCurrent" class="form-label">Password lama</label>
                                        <input type="password" name="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            id="inputPasswordCurrent" autofocus>
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPasswordNew" class="form-label">Password baru</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="inputPasswordNew">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPasswordNew2" class="form-label">ulangi password</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="inputPasswordNew2">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah password</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
