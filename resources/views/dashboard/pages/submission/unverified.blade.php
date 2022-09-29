@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman data Pengajuan Belum Terverifikasi</h1>

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <x-alert-success></x-alert-success>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelompok</th>
                                    <th>Ketua Kelompok</th>
                                    <th>Nomor Surat Pengajuan</th>
                                    <th>Tanggal Surat Pengajuan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status Pengajuan</th>
                                    <th>Diajukan Oleh</th>
                                    <th>Aksi</th>
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
        document.addEventListener("DOMContentLoaded", function() {

            $(document).on('click', '.delete', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('submissions.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                scrollX: true,
                scrollY: '500px',
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('submission.unverified') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'group_name',
                        name: 'group_name'
                    },
                    {
                        data: 'group_leader',
                        name: 'group_leader'
                    },
                    {
                        data: 'letter_number',
                        name: 'letter_number'
                    },
                    {
                        data: 'date',
                        name: 'date'
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
                        data: 'submission_status',
                        name: 'submission_status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'users.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
