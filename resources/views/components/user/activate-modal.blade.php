<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Aktivasi Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="deleteForm" method="POST">
                @csrf
                <div class="modal-body m-3">
                    <p class="mb-0">Apa anda yakin ingin mengaktifkan pengguna? pengguna yang diaktifkan akan dapat
                        login dan mengakses fitur sesuai dengan jabatannya</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Aktifkan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END primary modal -->
