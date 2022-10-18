@extends('layouts.app')

@section('head')
<style>
    .container-page {
        height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

@section('content')
<div class="container container-page">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center" >
                <h4>Cari kartu berdasar NIK</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('check-nik') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">NIK <small class="text-danger">*</small></label>
                            <input value="{{ old('nik') }}" type="text" name="nik" autocomplete="off"
                                           class="form-control @error('nik') is-invalid @enderror"
                                           placeholder="123456789xxxxxxx" autofocus>
                            @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
    
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mb-4">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>

                       
                    </div>
                </form>
                <div class="row">
                    @if (session('success'))
                    <div class="col-mb-12">
                         <div class="alert alert-success p-3" role="alert">
                             {{ session('success')}} <b> {{ session('data')->name }}</b>
                         </div>
                    </div>

                    <div class="col-md-12">
                     <table class="table">
                         <thead>
                           <tr>
                             <th scope="col">NIK</th>
                             <th scope="col">Nama</th>
                             <th scope="col">Aksi</th>
                           </tr>
                         </thead>
                         <tbody>
                           <tr>
                             <th scope="row">{{ session('data')->national_identity_number }}</th>
                             <td>{{ session('data')->name }}</td>
                             <td>
                                 <form target="_blank" action="{{ route('print-card') }}" method="post">
                                    @csrf
                                     <input type="hidden" name="nik" value="{{ session('data')->national_identity_number }}">
                                     <button class="btn btn-primary" type="submit">Cetak</button>
                                 </form>
                             </td>
                           </tr>
                         </tbody>
                       </table>
                    </div>
                    @endif

                    @if (session('notfound'))
                    <div class="col-mb-12">
                         <div class="alert alert-danger p-3" role="alert">
                             {{ session('notfound') }}
                         </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
