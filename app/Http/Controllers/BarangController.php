<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $q = DB::table('barangs')->select(DB::raw('MAX(RIGHT(kode_barang, 3)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else {
            $kd = "001";
        }
        return view('master-barang', ['barang' => $barang], ['kd' => $kd]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }
    
    public function tampilSemuaBarang(){
        $barang = Barang::all();
        return response()->json([
            'barang' => $barang
        ]);
    }

    public function store(Request $request){
        $message = [
            'required' => ':attribute harus diisi'
        ];
        $validator = Validator::make($request->all(),[
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'satuan_barang' => 'required',
            'harga_beli' => 'required',
            'status_barang' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        else {
            $barang = new Barang;
            $barang->kode_barang = $request->input('kode_barang');
            $barang->nama_barang = $request->input('nama_barang');
            $barang->jumlah_barang = $request->input('jumlah_barang');
            $barang->satuan_barang = $request->input('satuan_barang');
            $barang->harga_beli = $request->input('harga_beli');
            $barang->status_barang = $request->input('status_barang');
            $barang->save();
            return response()->json([
                'status' => 200,
                'message' => 'Tambah barang berhasil'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        if ($barang) {
            return response()->json([
                'status' => 200,
                'barang' => $barang
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Barang tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute harus diisi'
        ];
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'satuan_barang' => 'required',
            'harga_beli' => 'required',
            'status_barang' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $barang = Barang::find($id);
            if ($barang) {
                $barang->kode_barang = $request->input('kode_barang');
                $barang->nama_barang = $request->input('nama_barang');
                $barang->jumlah_barang = $request->input('jumlah_barang');
                $barang->satuan_barang = $request->input('satuan_barang');
                $barang->harga_beli = $request->input('harga_beli');
                $barang->status_barang = $request->input('status_barang');
                $barang->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Update data barang berhasil'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Barang tidak ditemukan'
                ]);
            }
            
        }
    }


    public function tambah_jumlahbarang(Request $request, $id)
    {

            $barang = Barang::find($id);
            if ($barang) {
                $barang->jumlah_barang = $request->input('jumlah_barang') + 1;
                $barang->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Update data barang berhasil'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Gagal'
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::find($id)->delete();
        BarangKeluar::where('id_barang', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => "Hapus data berhasil"
        ]);
    }
}
