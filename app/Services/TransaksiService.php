<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Transaksi;

class TransaksiService
{
    public function createTransaksi($request){
        $transaksi = Transaksi::create([
            'id_barang' => $request['id_barang'],
            'jumlah'    => $request['jumlah'],
            'harga_modal'   => $request['harga_modal'],
            'harga_jual'    => $request['harga_jual'],
            'tanggal'       => NOW(),
            'type'          => $request['type']
        ]);

        return $transaksi;
    }

    public function getAll($type){
        $transaksi = Transaksi::with('barang')->where('type', $type)->paginate(10);

        return $transaksi;
    }

    public function getById($id, $type){
        $transaksi = Transaksi::with('barang')->where('id_barang', $id)->where('type', $type)->paginate(10);

        return $transaksi;
    }

    public function getData($id, $type){
        $transaksi = Transaksi::where('id_barang', $id)->where('type', 'keluar')->get();

        return $transaksi;
    }

    public function filter($query, $request){
        
        if (!empty($request['id_barang'])) {
            $query->where('id_barang', $request['id_barang']);
        }
        if (!empty($request['start_date']) && !empty($request['end_date'])) {
            $query->whereBetween('tanggal', [$request['start_date'], $request['end_date']]);
        }

        return $query;
    }
}