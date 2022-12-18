@extends('dashboard.layouts.main')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Halaman data Stasiun</h1>

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
                                <th>Nama</th>
                                <th>Nomor</th>
                                <th>Alamat</th>
                                <th>Nama PIC</th>
                                <th>Nomor PIC</th>
                                <th>Tipe</th>
                                <th>Kecamatan</th>
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
        document.addEventListener("DOMContentLoaded", function () {

            $(document).on('click', '.delete', function () {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('stations.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

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
                ajax: "{{ route('stations.index') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'number',
                        name: 'number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'pic_name',
                        name: 'pic_name'
                    },
                    {
                        data: 'pic_phone',
                        name: 'pic_phone'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'district.name',
                        name: 'district.name'
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
