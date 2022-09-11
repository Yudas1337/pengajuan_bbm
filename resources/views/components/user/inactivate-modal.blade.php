<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Penonaktifan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body m-3">
                    <p class="mb-0">Apa anda yakin ingin menonaktifkan pengguna? pengguna yang dinonaktifkan tidak akan
                        dapat login dan harus diaktifkan ulang</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END primary modal -->
