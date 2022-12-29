<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    @yield('head')
</head>
<body onload="window.print()">
    <div class="container-fluid mt-5">
        <table class="table-bordered table-striped" style="width: 100%">
            <thead>
            <th>Penerima Bantuan</th>
            <th>Tanggal Transaksi</th>
            <th>Banyak Kuota</th>
            <th>Petugas yang menangani</th>
            <th>Stasiun</th>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{ $d->submission_receiver->receiver->name }}</td>
                    <td>{{ $d->submmission_history_created }}</td>
                    <td>{{ $d->quota_cost }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td>{{ $d->user->station->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
