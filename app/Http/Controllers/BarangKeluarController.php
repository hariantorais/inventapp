<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function tampilBarangKeluar(){
        $barangkeluar = DB::table('barang_keluars')
                            ->select('*', 'barang_keluars.id as id_keluar')
                            ->join('barangs', 'barang_keluars.id_barang', '=', 'barangs.id')
                            ->orderBy('created_at', 'desc')
                            ->get();
        return response()->json([
            'barangkeluar' => $barangkeluar
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi'
        ];
        $validator = Validator::make($request->all(), [
            'jumlah_barang' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $barangkeluar = new BarangKeluar;
            $barangkeluar->id_barang = $request->input('id_barang');
            $barangkeluar->jumlah = $request->input('jumlah_barang');
            $barangkeluar->save();

            $barang = Barang::where('id', $request->input('id_barang'))->first();
            $barang->jumlah_barang = $barang->jumlah_barang - $request->input('jumlah_barang');
            $barang->update();
            return response()->json([
                'status' => 200,
                'message' => 'Tambah Barang Keluar Berhasil'
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
        //
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
        //   
    }

    public function batalkan(Request $request, $id)
    {

        $barang = Barang::where('id', $request->input('id_barang'))->first();
        $barang->jumlah_barang = $barang->jumlah_barang + $request->input('jumlah_keluar');
        $barang->update();
        BarangKeluar::find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //    

    }
}
