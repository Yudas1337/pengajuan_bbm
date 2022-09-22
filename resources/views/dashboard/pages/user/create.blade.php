@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Data Pengguna</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama Lengkap <small class="text-danger">*</small> </label>
                                <input value="{{ old('name') }}" type="text" name="name" autocomplete="off"
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
                                <input value="{{ old('email') }}" type="text" name="email" autocomplete="off"
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
                            <label for="select-ships" class="form-label">Alamat SPBU</label>
                            <select id="select-ships" name="station_id" class="form-control select2-ajax">
                                <option value="">--Pilih SPBU--</option>
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
                                <input value="{{ old('username') }}" type="text" name="username" autocomplete="off"
                                       class="form-control @error('username') is-invalid @enderror"
                                       placeholder="john.doe">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password <small class="text-danger">*</small></label>
                                <input value="{{ old('password') }}" type="password" name="password"
                                       autocomplete="off"
                                       class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="select-ships" class="form-label">Jabatan <small
                                    class="text-danger">*</small></label>
                            <select id="select-roles" name="roles" class="form-control" required>
                                <option value="">--Pilih Jabatan--</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="container-districts" class="mb-3 col-md-12" style="display: none">
                            <label class="form-label">Lokasi Kecamatan<small class="text-danger">*</small> </label>
                            <select id="select-districts" name="district_id" class="form-control select-districts">
                                <option value="">--Pilih Kecamatan--</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @error('district_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
            $('#select-roles').change(() => {
                const roles = $('#select-roles').val()
                if (roles === 'Penyuluh') {
                    $('#container-districts').css('display', 'block')
                } else {
                    $('#container-districts').css('display', 'none')
                }
            })
            $('.select-districts').select2()
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
