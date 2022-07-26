<div id="modalBarangKeluar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="keluar_id">
                <div class="mb-3 row align-item-center">
                    <div class="col-4">
                        <label class="form-label">Kode Barang</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="keluar_kode_barang" class="form-control" readonly>
                    </div>
                </div>
                <div class="mb-3 row align-item-center">
                    <div class="col-4">
                        <label class="form-label">Nama Barang</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="keluar_nama_barang" class="form-control" readonly>
                    </div>
                </div>
                <div class="mb-3 row align-item-center">
                    <div class="col-4">
                        <label class="form-label">Stok Barang</label>
                    </div>
                    <div class="col-8">
                        <input type="number" name="keluar_jumlah_barang" class="form-control" readonly>
                    </div>
                </div>
                <div class="mb-3 row align-item-center">
                    <div class="col-4">
                        <label class="form-label">Jumlah Barang Keluar</label>
                    </div>
                    <div class="col-8">
                        <input type="number" name="keluar_jumlah_barangkeluar" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmitKeluar" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>