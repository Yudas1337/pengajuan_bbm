@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Update Data Pengguna</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama Lengkap <small class="text-danger">*</small> </label>
                                <input value="{{ $user->name }}" type="text" name="name" autocomplete="off"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="John Doe" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email <small class="text-danger">*</small></label>
                                <input value="{{ $user->email }}" type="text" name="email" autocomplete="off"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="johndoe@example.com">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="select-ships" class="form-label">Alamat SPBU <small
                                    class="text-danger">*</small></label>
                            <select id="select-ships" name="station_id" required class="form-control select2-ajax">
                                <option value="{{ $user->station_id  }}"
                                        selected="selected">{{ $user->station()->first()->name }}</option>
                            </select>
                            @error('station_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Username <small class="text-danger">*</small></label>
                                <input value="{{ $user->username }}" type="text" name="username" autocomplete="off"
                                       class="form-control @error('username') is-invalid @enderror"
                                       placeholder="john.doe">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="select-ships" class="form-label">Jabatan <small
                                        class="text-danger">*</small></label>
                                <select id="select-roles" name="roles" class="form-control" required>
                                    <option value="">--Pilih Jabatan--</option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->name }}" {{ $role->name === $user->roles->first()->name ? 'selected' : '' }}>{{ $role->name  }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Update data</button>
                        <button type="reset" class="btn btn-secondary">Kosongkan form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('.select2-ajax').select2({
                ajax: {
                    url: `{{ route('stations.performAjax') }}`,
                    type: 'get',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            term: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response.results,
                            pagination: {
                                more: response.pagination.more
                            }
                        };
                    },
                    cache: false
                },
                placeholder: 'Cari Alamat SPBU'
            });
        });
    </script>

@endsection
