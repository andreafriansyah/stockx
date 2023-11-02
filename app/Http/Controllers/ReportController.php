<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Services\BarangService;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Exception;

class ReportController extends Controller
{
    protected $barangService, $transaksiService;

    public function __construct(BarangService $barangService, TransaksiService $transaksiService)
    {
        $this->middleware('auth');
        $this->barangService = $barangService;
        $this->transaksiService = $transaksiService;
    }

    public function indexIn(Request $request)
    {
        $query = Transaksi::with('barang');

        $query = $this->transaksiService->filter($query, $request->all());

        $transaksi = $query->where('type', 'masuk')->paginate(10);

        $barang = $this->barangService->getList();

        return view('report.indexIn', compact('transaksi', 'barang'));
    }

    public function indexOut(Request $request)
    {
        $query = Transaksi::with('barang');

        $query = $this->transaksiService->filter($query, $request->all());

        $transaksi = $query->where('type', 'keluar')->paginate(10);

        $barang = $this->barangService->getList();

        return view('report.indexOut', compact('transaksi', 'barang'));
    }

    public function detailTrx($id)
    {
        $barang = $this->barangService->getById($id);

        $barang->profit = $this->hitungProfit($id);
        $barang->total_barang = $this->hitungTotalBarang($id);

        $transaksi = $this->transaksiService->getById($id, 'keluar');

        return view('report.detailTrx', compact('barang', 'transaksi'));
    }

    private function hitungProfit($id){
        $transactions = $this->transaksiService->getData($id, 'keluar');

        $keuntungan = $transactions->sum('keuntungan');
        $keuntungan = 'Rp ' . number_format($keuntungan, 0, ',', '.');

        return $keuntungan;
    }

    private function hitungTotalBarang($id){
        $transactions = $this->transaksiService->getData($id, 'keluar');

        $totalBarang = $transactions->sum('jumlah');

        return $totalBarang;
    }
}
