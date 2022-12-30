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
            <th>Kelompok</th>
            <th>Ketua</th>
            <th>Tipe</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Kecamatan</th>
            <th>Total Penerima Bantuan</th>
            <th>Total Kuota</th>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{ $d->group->group_name }}</td>
                    <td>{{ $d->group->user->name }}</td>
                    <td>{{ $d->group->receiver_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->start_time)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->end_time)->format('d M Y') }}</td>
                    <td>{{ $d->group->user->district->name }}</td>
                    <td>{{ $d->submission_receivers_count }}</td>
                    <td>{{ $d->submission_receivers_sum_quota }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
