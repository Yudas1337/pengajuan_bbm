@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3>Selamat Datang, {{ auth()->user()->name }}</h3>
            </div>

        </div>

    </div>
@endsection
