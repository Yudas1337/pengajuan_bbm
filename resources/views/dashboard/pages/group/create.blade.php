@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Data Kelompok</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('groups.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama Kelompok<small class="text-danger">*</small> </label>
                                <input value="{{ old('group_name') }}" type="text" name="group_name" autocomplete="off"
                                       class="form-control @error('group_name') is-invalid @enderror"
                                       placeholder="Kelompok Satu" autofocus>
                                @error('group_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Ketua Kelompok <small class="text-danger">*</small></label>
                                <select name="group_leader_id" class="form-control select2-ajax @error('group_leader_id') is-invalid @enderror">
                                    @foreach($leader as $l)
                                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_leader_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>

                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Penerima <small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <label class="form-check">
                                        <input value="Nelayan" name="receiver_type" type="radio"
                                            class="form-check-input @error('receiver_type') is-invalid @enderror">
                                        <span class="form-check-label">Nelayan</span>
                                    </label> 
                                    <label class="form-check">
                                        <input value="Pembudidaya" name="receiver_type" type="radio"
                                            class="form-check-input @error('receiver_type') is-invalid @enderror">
                                        <span class="form-check-label">Pembudidaya</span>
                                    </label>
                                </div>
                                @error('receiver_type')
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
    <script src="{{ asset('app-assets/js/jquery.form.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('.select2-ajax').select2();
        });
    </script>
@endsection
