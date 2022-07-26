@extends('_layout')
@section('judul', 'Master Barang')
@section('content')
<div class="container">
    <main class="position-relative">
        <div class="card mt-3 col-md-8 mx-auto">
            <div class="card-header">
                <strong>Master Data Barang</strong>
                <div class="float-sm-end">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" id="btnTambah">
                        <i class="fa fa-plus"></i>   Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- table -->
                <table class="table table-striped table-bordered" style="width:100%;">
                    <thead class="bg-green">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tblMasterBarang">
                        
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card mt-3 col-md-8 mx-auto">
            <div class="card-header">
                <strong>Barang Keluar</strong>
            </div>
            <div class="card-body">
                <!-- table -->
                <table class="table table-striped table-bordered" style="width:100%;">
                    <thead class="bg-green">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tblBarangKeluar">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>    
@endsection
