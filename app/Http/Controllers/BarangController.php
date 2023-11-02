<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Services\BarangService;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $barangService, $uploadFileService;

    public function __construct(BarangService $barangService, UploadFileService $uploadFileService)
    {
        $this->middleware('auth');
        $this->barangService = $barangService;
        $this->uploadFileService = $uploadFileService;
    }

    public function index()
    {
        $dataBarang = $this->barangService->getAll();

        return view('barang.index', compact('dataBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang'   => 'required|unique:barangs',
            'nama'          => 'required',
            'detail'        => 'required',
            'harga_modal'    => 'required',
            'harga_jual'    => 'required',
            'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'jumlah'        => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
    
        try {
            if($request->hasFile('foto')){
                $request['image_path'] = $this->uploadFileService->uploadFile($request->file('foto'),  'barang');
            }

            $dataBarang = $this->barangService->storeBarang($request->all());

            return redirect()->route('indexBarang')->withSuccess('Berhasil menambah data Barang');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Gagal menambah data Barang');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $barang = $this->barangService->getById($id);

            return view('barang.show', compact('barang'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $barang = $this->barangService->getById($id);

            return view('barang.edit', compact('barang'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang'   => 'required',
            'nama'          => 'required',
            'detail'        => 'required',
            'foto'          => 'image|mimes:jpeg,jpg,png|max:2048',
            'jumlah'        => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        try{
            
            if($request->hasFile('foto')){
                $request['image_path'] = $this->uploadFileService->uploadFile($request->file('foto'),  'barang');
            }
            
            $updateBarang = $this->barangService->updateBarang($id, $request);

            return redirect()->route('indexBarang')->withSuccess('Berhasil mengupdate data Barang');
        }catch(Exception $e){
            return redirect()->back()->withErrors('Gagal mengupdate data Barang');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->barangService->updateStok($id, 0);

            $deleteBarang = $this->barangService->deleteBarang($id);

            return response()->json(['message' => 'Berhasil menghapus data Barang', 'code' => 204]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data Barang', 'code' => 400]);
        }
    }

    public function getDetail($id){
        try {
            $detailBarang = $this->barangService->getById($id);

            return response()->json(['data' => $detailBarang, 'code' => 204]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data Barang', 'code' => 400]);
        }
    }
}
