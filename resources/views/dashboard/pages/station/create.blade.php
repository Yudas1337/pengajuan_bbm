@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Data Stasiun</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('stations.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama SPBU <small class="text-danger">*</small> </label>
                                <input value="{{ old('name') }}" type="text" name="name" autocomplete="off"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="SPBU Malang" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor SPBU <small class="text-danger">*</small></label>
                                <input value="{{ old('number') }}" type="text" name="number" autocomplete="off"
                                       class="form-control @error('number') is-invalid @enderror"
                                       placeholder="3412404">
                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat SPBU <small class="text-danger">*</small></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                      autocomplete="off">{{ old('address')  }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama PIC <small class="text-danger">*</small></label>
                                <input value="{{ old('pic_name') }}" type="text" name="pic_name" autocomplete="off"
                                       class="form-control @error('pic_name') is-invalid @enderror"
                                       placeholder="John Doe">
                                @error('pic_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor PIC <small class="text-danger">*</small></label>
                                <input value="{{ old('pic_phone') }}" type="number" name="pic_phone"
                                       autocomplete="off"
                                       class="form-control @error('pic_phone') is-invalid @enderror"
                                       placeholder="081253232102">
                                @error('pic_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tipe <small class="text-danger">*</small></label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="">--Pilih--</option>
                                    <option {{ old('type') == 'spbu' ? 'selected' : ''  }} value="spbu">SPBU</option>
                                    <option {{ old('type') == 'spbn' ? 'selected' : ''  }} value="spbn">SPBN</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Kecamatan <small class="text-danger">*</small></label>
                                <select name="district_id" class="form-control select2-ajax @error('type') is-invalid @enderror">
                                    <option value="">--Pilih--</option>
                                    @foreach($districts as $district)
                                        <option {{ old('district_id') == $district->id ? 'selected' : ''  }} value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('.select2-ajax').select2();
        })
    </script>
@endsection
