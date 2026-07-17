<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SetoranSampah;
use App\Models\CashflowPengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGudangController extends Controller
{
    /**
     * Display stock in warehouse and total values.
     */
    public function index()
    {
        $stokGudang = SetoranSampah::where('status', 'gudang')
            ->select('jenis_sampah', 
                DB::raw('SUM(berat_kg) as total_berat'),
                DB::raw('SUM(total_harga_nasabah) as total_beli'),
                DB::raw('SUM(berat_kg * harga_jual_pengepul) as total_jual')
            )
            ->groupBy('jenis_sampah')
            ->get()
            ->keyBy('jenis_sampah');

        // Total accumulation
        $totalBerat = SetoranSampah::where('status', 'gudang')->sum('berat_kg');
        $totalEstimasiJual = SetoranSampah::where('status', 'gudang')
            ->select(DB::raw('SUM(berat_kg * harga_jual_pengepul) as total'))
            ->first()
            ->total ?? 0;
        $totalBeliNasabah = SetoranSampah::where('status', 'gudang')->sum('total_harga_nasabah');
        $estimasiKeuntungan = $totalEstimasiJual - $totalBeliNasabah;

        return view('admin.gudang.index', compact('stokGudang', 'totalBerat', 'totalEstimasiJual', 'totalBeliNasabah', 'estimasiKeuntungan'));
    }

    /**
     * Confirm sale of all stock in the warehouse.
     */
    public function jual(Request $request)
    {
        // 1. Get all gudang logs
        $gudangLogs = SetoranSampah::where('status', 'gudang')->get();

        if ($gudangLogs->isEmpty()) {
            return redirect()->back()->withErrors(['gudang' => 'Tidak ada stok sampah di gudang yang bisa dijual.']);
        }

        // 2. Calculate total margin
        $totalMargin = 0;
        foreach ($gudangLogs as $log) {
            $margin = ($log->harga_jual_pengepul - $log->harga_beli_nasabah) * $log->berat_kg;
            $totalMargin += $margin;
        }

        DB::transaction(function () use ($totalMargin) {
            // 3. Mark all as sold (terjual)
            SetoranSampah::where('status', 'gudang')->update(['status' => 'terjual']);

            // 4. Inject profit into cashflow_pengelola
            $lastCashflow = CashflowPengelola::orderBy('id', 'desc')->first();
            $lastSaldo = $lastCashflow ? $lastCashflow->sisa_saldo_kas : 0;
            $newSaldo = $lastSaldo + $totalMargin;

            CashflowPengelola::create([
                'jenis_aliran' => 'masuk',
                'nominal' => $totalMargin,
                'kategori' => 'keuntungan_bersih',
                'keterangan' => 'Keuntungan bersih akumulasi penjualan sampah gudang ke pengepul',
                'sisa_saldo_kas' => $newSaldo,
            ]);
        });

        return redirect()->back()->with('success', 'Stok sampah berhasil dikonfirmasi terjual! Keuntungan bersih sebesar Rp ' . number_format($totalMargin, 0, ',', '.') . ' telah dimasukkan ke kas internal pengelola.');
    }
}
