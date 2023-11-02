<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Barang;

class BarangService
{
    public function getAll(){
        $barang = Barang::latest()->paginate(10);

        return $barang;
    }

    public function getList(){
        $barang = Barang::select('id', 'nama', 'kode_barang')->get();

        return $barang;
    }

    public function getById($id){
        $barang = Barang::where('id', $id)->first();

        return $barang;
    }

    public function storeBarang($request){
        $data = Barang::create([
            'kode_barang' => $request['kode_barang'],
            'nama' => $request['nama'],
            'detail' => $request['detail'],
            'foto' => $request['image_path'],
            'jumlah' => $request['jumlah'],
            'harga_modal'   => $request['harga_modal'],
            'harga_jual'   => $request['harga_jual']
        ]);

        return $data;
    }

    public function updateBarang($id, $request){
        $barang = $this->getById($id);

        $updateBarang = $barang->update([
            'kode_barang' => $request['kode_barang'],
            'nama' => $request['nama'],
            'detail' => $request['detail'],
            'foto' => $request['image_path'],
            'jumlah' => $request['jumlah'],
            'harga_modal'   => $request['harga_modal'],
            'harga_jual'   => $request['harga_jual']
        ]);        

        return $updateBarang;
    }

    public function updateStok($id, $stok){
        $barang = $this->getById($id);

        $updateBarang = $barang->update([
            'jumlah'   => $stok
        ]);

        return $updateBarang;
    }

    public function deleteBarang($id){
        $barang = $this->getById($id);

        $barang->delete();

        return $barang;
    }

}
