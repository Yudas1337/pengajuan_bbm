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
                        <div class="col-12">
                                <form id="search-form" class="row justify-content-end" action="" method="GET">
                                    <div class="col-4"><input type="text" name="date" value="{{ date('Y-m-d') . ' - ' . date('Y-m-d') }}" class="form-control"></div>
                                    <div class="col-2 d-flex flex-row">
                                        <button class="btn btn-primary me-2" type="submit">Cari</button>
                                        <button id="btn-print" class="btn btn-dark">Print</button>
                                    </div>
                                </form>
                        </div>
                        <div class="col-12 mt-3">
                            <table id="datatables-responsive" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
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
        </div>

        <x-delete-modal></x-delete-modal>

    </div>
@endsection
@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Datatables Responsive
            var table = $("#datatables-responsive").DataTable({
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: false,
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false,
                ajax: "{{ route('histories.index') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}",
                columns: [
                    {
                        data: 'receiver',
                        name: 'submission_receiver.receiver.name'
                    },
                    {
                        data: 'submmission_history_created',
                        name: 'submmission_history_created'
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

            $('#search-form').submit(function (e){
                e.preventDefault()
                const date = $('input[name="date"]').val()
                table.ajax.url("{{ route('histories.index') . '?date=:date' }}".replace(':date', date))
                table.ajax.reload()
            })

            $('#btn-print').click(function() {
                const date = $('input[name="date"]').val()
                window.open("{{ route('print-history', ':date') }}".replace(':date', date), '_blank')
            })

            // Daterangepicker
            $("input[name=\"date\"]").daterangepicker({
                opens: "left",
                locale: {
                    format: 'Y-M-D'
                }
            });
        });
    </script>
@endsection
