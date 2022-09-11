@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman data Pengajuan</h1>

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-message">
                            <strong>Sukses!</strong> {{ session('success') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>No Registrasi</th>
                                <th>Kapal</th>
                                <th>Berangkat dari</th>
                                <th>Tujuan</th>
                                <th>Waktu Berangkat</th>
                                <th>Waktu Tiba</th>
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
                        <h5 class="modal-title">Konfirmasi Penghapusan Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body m-3">
                            <p class="mb-0">Apa anda yakin ingin menghapus data? data akan dihapus permanen dan tidak
                                dapat dikembalikan</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
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
                let url = `{{ route('shippings.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                button: [{
                    extend: 'pdf'
                }],
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: true,
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('shippings.index') }}",
                columns: [{
                    data: 'shipping_license',
                    name: 'shipping_license'
                },
                    {
                        data: 'ship.name',
                        name: 'ship.name'
                    },
                    {
                        data: 'harbor_departure_from.name',
                        name: 'harbor_departure_from.name'
                    },
                    {
                        data: 'harbor_port_destination.name',
                        name: 'harbor_port_destination.name'
                    },
                    {
                        data: 'depart_time',
                        name: 'depart_time'
                    },
                    {
                        data: 'arrived_time',
                        name: 'arrived_time'
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
