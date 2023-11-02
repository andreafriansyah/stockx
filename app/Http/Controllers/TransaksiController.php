<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Services\BarangService;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $barangService, $transaksiService;

    public function __construct(BarangService $barangService, TransaksiService $transaksiService)
    {
        $this->middleware('auth');
        $this->barangService = $barangService;
        $this->transaksiService = $transaksiService;
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createIn()
    {
        $barang = $this->barangService->getList();


        return view('transaksi.create-in', compact('barang'));
    }

    public function createOut()
    {
        $barang = $this->barangService->getList();


        return view('transaksi.create-out', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_barang'   => 'required',
            'harga_modal'    => 'required',
            'harga_jual'    => 'required',
            'jumlah'        => 'required|numeric',
            'type'          => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        try { 
            $barang = $this->barangService->getById($request->id_barang);

            if($request->type == 'masuk'){
                $barang->jumlah += $request->jumlah;
            }else{
                $barang->jumlah -= $request->jumlah;
            }
            
            $updateStok = $this->barangService->updateStok($request->id_barang, $barang->jumlah);

            $transaksi = $this->transaksiService->createTransaksi($request);

            Alert::success('Success!', 'Berhasil menambah Transaksi');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::error('Failed!', 'Gagal menambah Transaksi');
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
