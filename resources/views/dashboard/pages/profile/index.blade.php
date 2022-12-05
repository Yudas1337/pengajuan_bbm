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
                        <a class="list-group-item list-group-item-action active" href="{{ route('user.profile') }}"
                           role="tab" aria-selected="true">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" href="{{ route('user.change-password') }}"
                           role="tab" aria-selected="false" tabindex="-1">
                            Password
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="account" role="tabpanel">
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
                            <div class="card-header">
                                <h5 class="card-title mb-0">Akun</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.updateProfile', auth()->id()) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Display Name</label>
                                                <input autocomplete="off" name="name" autofocus type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       id="inputUsername" placeholder="Nama lengkap"
                                                       value="{{ auth()->user()->name }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Email</label>
                                                <input autocomplete="off" type="text" name="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       id="inputUsername" placeholder="Email"
                                                       value="{{ auth()->user()->email }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Username</label>
                                                <input autocomplete="off" type="text" name="username"
                                                       class="form-control @error('username') is-invalid @enderror"
                                                       id="inputUsername" placeholder="Username"
                                                       value="{{ auth()->user()->username }}">
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">NIK</label>
                                                <input autocomplete="off" type="text" name="national_identity_number"
                                                       class="form-control @error('national_identity_number') is-invalid @enderror"
                                                       id="inputUsername" placeholder="350xxxxxxxxxxxxx"
                                                       value="{{ auth()->user()->national_identity_number }}">
                                                @error('national_identity_number')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="inputUsername" class="form-label">Alamat</label>
                                                <textarea autocomplete="off" type="text" name="address"
                                                       class="form-control @error('address') is-invalid @enderror"
                                                       id="inputUsername" placeholder="jl. soekarno hatta no 10">{{ auth()->user()->address }}</textarea>
                                                @error('national_identity_number')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Perbarui profil</button>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
