@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman data transaksi</h1>

        <div class="row">
            <div class="col-12">

                @if (session('success'))
                    <x-alert-success></x-alert-success>
                @elseif(session('errors'))
                    <x-alert-failed></x-alert-failed>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table id="datatables-responsive" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Penerima Bantuan</th>
                                <th>Tanggal transaksi</th>
                                <th>Banyak Kuota</th>
                                <th>Petugas yang menangani</th>
                                <th>Stasiun</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <x-delete-modal></x-delete-modal>

    </div>
@endsection
@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Datatables Responsive
            $("#datatables-responsive").DataTable({
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: false,
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('histories.index') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'receiver',
                        name: 'submission_receiver.receiver.name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'quota_cost',
                        name: 'quota_cost'
                    },
                    {
                        data: 'user',
                        name: 'user.name'
                    },
                    {
                        data: 'station',
                        name: 'user.station.name'
                    }

                ]
            });
        });
    </script>
@endsection
