<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('app-assets/img/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <link class="js-stylesheet" href="{{ asset('app-assets/css/light.css') }}" rel="stylesheet">

    <style>
        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .container .card {

        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center" >
                    <h2>Cari kartu berdasar NIK</h2>
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
</body>
</html>