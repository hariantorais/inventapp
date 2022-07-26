<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                     <div class="mb-3 row align-item-center">
                        <div class="col-4">
                            <label class="form-label">Kode Barang</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="kode_barang" value="{{ 'BR'.$kd }}" class="form-control" readonly>
                            <small id="kode_barang_error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3 row align-item-center">
                        <div class="col-4">
                            <label class="form-label">Nama Barang</label>
                        </div>
                        <div class="col-8">
                            <input autofocus type="text" name="nama_barang" class="form-control">
                            <small id="nama_barang_error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3 row align-item-center">
                        <div class="col-4">
                            <label class="form-label">Satuan Barang</label>
                        </div>
                        <div class="col-8">
                            <select class="form-select" name="satuan_barang" aria-label="Default select example">
                                <option value="">-Pilih-</option>
                                <option>Kg</option>
                                <option>Pcs</option>
                                <option>Liter</option>
                                <option>Meter</option>
                            </select>
                            <small id="satuan_barang_error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3 row align-item-center">
                        <div class="col-4">
                            <label class="form-label">Jumlah Barang</label>
                        </div>
                        <div class="col-8">
                            <input type="number" name="jumlah_barang" class="form-control">
                            <small id="jumlah_barang_error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3 row align-item-center">
                        <div class="col-4">
                            <label class="form-label">Harga Beli</label>
                        </div>
                        <div class="col-8">
                            <input type="number" name="harga_beli" class="form-control">
                            <small id="harga_beli_error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3 row align-item-center">
                        <div class="col-4">
                            <label class="form-label">Status Barang</label>
                        </div>
                        <div class="col-8">
                            <select class="form-select" name="status_barang" aria-label="Default select example">
                                <option value="1">Available</option>
                                <option value="0">Not-available</option>
                            </select>
                            <small id="status_barang_error" class="text-danger"></small>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSimpan" class="btn btn-sm btn-primary">Simpan</button>
                </div>
        </div>
    </div>
</div>