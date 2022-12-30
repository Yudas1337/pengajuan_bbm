@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Data Penerima Bantuan</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('receivers.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama <small class="text-danger">*</small> </label>
                                <input value="{{ old('name') }}" type="text" name="name" autocomplete="off"
                                       class="form-control @error('name') is-invalid @enderror" placeholder="John Doe"
                                       autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">NIK <small class="text-danger">*</small></label>
                                <input value="{{ old('national_identity_number') }}" type="text"
                                       name="national_identity_number" autocomplete="off"
                                       class="form-control @error('national_identity_number') is-invalid @enderror"
                                       placeholder="3412404868920002">
                                @error('national_identity_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tipe <small class="text-danger">*</small> </label>
                                <input value="{{ old('receiver_type') }}" type="text" name="receiver_type"
                                       autocomplete="off"
                                       class="form-control @error('receiver_type') is-invalid @enderror"
                                       placeholder="Perorangan" autofocus>
                                @error('receiver_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor Telepon <small class="text-danger">*</small></label>
                                <input value="{{ old('phone_number') }}" type="text" name="phone_number"
                                       autocomplete="off"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       placeholder="0857364xxxxx">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tempat Lahir <small class="text-danger">*</small> </label>
                                <input value="{{ old('birth_place') }}" type="text" name="birth_place"
                                       autocomplete="off"
                                       class="form-control @error('birth_place') is-invalid @enderror"
                                       placeholder="Gresik" autofocus>
                                @error('birth_place')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                                <input value="{{ old('birth_date') }}" type="date" name="birth_date"
                                       autocomplete="off"
                                       class="form-control @error('birth_date') is-invalid @enderror">
                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Provinsi <small class="text-danger">*</small> </label>
                                <select id="select-provinces" name="province" class="form-control select2-ajax"
                                        disabled>
                                    <option value="JAWA TIMUR" selected>JAWA TIMUR</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kabupaten / Kota <small class="text-danger">*</small></label>
                                <select id="select-regencies" name="regency" class="form-control select2-ajax" disabled>
                                    <option value="GRESIK" selected>Gresik</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kecamatan <small class="text-danger">*</small> </label>
                                <select id="select-districts" name="district" class="form-control select2-ajax">
                                    <option value="">--Pilih--</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->name }}" data-id="{{ $district->id }}">
                                            {{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Desa / Kelurahan <small class="text-danger">*</small></label>
                                <select id="select-villages" name="village" class="form-control select2-ajax">
                                    <option value="">--Pilih--</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat <small class="text-danger">*</small></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                      autocomplete="off"
                                      placeholder="alamat...">{{ old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama Kapal </label>
                                <input value="{{ old('ship_name') }}" type="text" name="ship_name"
                                       autocomplete="off"
                                       class="form-control @error('ship_name') is-invalid @enderror">
                                @error('ship_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Gross Tonase </label>
                                <input value="{{ old('gross_tonnage') }}" type="number" name="gross_tonnage"
                                       autocomplete="off"
                                       class="form-control @error('gross_tonnage') is-invalid @enderror">
                                @error('gross_tonnage')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Jenis Kelamin <small class="text-danger">*</small> </label>
                                <div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Laki-laki">
                                        <span class="form-check-label">
                                            Laki - Laki
                                        </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="Perempuan">
                                        <span class="form-check-label">
                                            Perempuan
                                        </span>
                                    </label>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status <small class="text-danger">*</small></label>
                                <select id="select-regencies" name="status" class="form-control select2-ajax">
                                    <option value="Valid" selected>Valid</option>
                                    <option value="Draft" selected>Draft</option>
                                    <option value="Perubahan" selected>Perubahan</option>
                                    <option value="Tidak Valid" selected>Tidak Valid</option>
                                </select>
                            </div>
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
    <script src="{{ asset('app-assets/js/jquery.form.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('.select2-ajax').select2();

            const fetchVillages = (id) => {
                const url = `{{ route('districts.villages', ':id') }}`.replace(':id', id);
                const select_villages = $("#select-villages");
                $.ajax({
                    url: url,
                    method: 'get',
                    success: (data) => {
                        $('#select-villages option').remove();
                        for (let i = 0; i < data.length; i++) {
                            let option = document.createElement("option");
                            option.value = data[i].name;
                            option.text = data[i].name;
                            select_villages.append(option);
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

            $('#select-districts').change(() => {
                var selectedOption = $('#select-districts')[0].selectedIndex;
                var option = $('#select-districts')[0][selectedOption];
                var id = option.getAttribute('data-id')
                fetchVillages(id)
            });
        });
    </script>
@endsection
