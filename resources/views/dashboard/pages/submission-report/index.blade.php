@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman data pengajuan</h1>

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
                                    <th>Kelompok</th>
                                    <th>Ketua</th>
                                    <th>Tipe</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Kecamatan</th>
                                    <th>Total Penerima Bantuan</th>
                                    <th>Total Kuota</th>
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
                ajax: "{{ route('submission-report.index') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}",
                columns: [
                    {
                        data: 'group.group_name',
                        name: 'group.group_name'
                    },
                    {
                        data: 'group.user.name',
                        name: 'group.user.name'
                    },
                    {
                        data: 'group.receiver_type',
                        name: 'group.receiver_type'
                    },
                    {
                        data: 'start_time',
                        name: 'start_time'
                    },
                    {
                        data: 'end_time',
                        name: 'end_time'
                    },
                    {
                        data: 'group.user.district.name',
                        name: 'group.user.district.name'
                    },
                    {
                        data: 'submission_receivers_count',
                        name: 'submission_receivers_count'
                    },
                    {
                        data: 'submission_receivers_sum_quota',
                        name: 'submission_receivers_sum_quota'
                    }
                ]

            });

            $('#search-form').submit(function (e){
                e.preventDefault()
                const date = $('input[name="date"]').val()
                table.ajax.url("{{ route('submission-report.index') . '?date=:date' }}".replace(':date', date))
                table.ajax.reload()
            })

            $('#btn-print').click(function() {
                const date = $('input[name="date"]').val()
                window.open("{{ route('submission-report.print', ':date') }}".replace(':date', date), '_blank')
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
