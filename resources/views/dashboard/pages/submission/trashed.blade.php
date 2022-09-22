@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman data Pengajuan</h1>

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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Aktivasi Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="deleteForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body m-3">
                            <p class="mb-0">Apa anda yakin ingin aktivasi ulang data? data pengajuan akan diaktifkan
                                kembali</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Aktivasi Pengajuan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END primary modal -->

    </div>
@endsection
@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            $(document).on('click', '.delete', function () {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('submission.restore', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                scrollX: true,
                scrollY: '300px',
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('submission.trashed') }}",
                columns: [
                    {
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
