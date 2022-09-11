@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Update Data SPBU</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('stations.update', $station->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama SPBU</label>
                                <input value="{{ $station->name }}" type="text" name="name" autocomplete="off"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="SPBU Malang" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor SPBU</label>
                                <input value="{{ $station->number }}" type="text" name="number" autocomplete="off"
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
                            <label class="form-label">Alamat SPBU</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                      autocomplete="off">{{ $station->address  }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama PIC</label>
                                <input value="{{ $station->pic_name }}" type="text" name="pic_name" autocomplete="off"
                                       class="form-control @error('pic_name') is-invalid @enderror"
                                       placeholder="John Doe">
                                @error('pic_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor PIC</label>
                                <input value="{{ $station->pic_phone }}" type="number" name="pic_phone"
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

                        <button type="submit" class="btn btn-success">Update Data</button>
                        <button type="reset" class="btn btn-secondary">Kosongkan form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
