<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SetoranSampah;
use App\Models\CashflowPengelola;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with metrics.
     */
    public function index()
    {
        // 1. General counts
        $totalNasabah = User::where('role', 'user')->count();
        $nasabahBaruBulanIni = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // 2. Metrics
        // Total Omset Berjalan: Sum of (berat_kg * harga_jual_pengepul) where status = 'gudang'
        $totalOmsetBerjalan = SetoranSampah::where('status', 'gudang')
            ->select(DB::raw('SUM(berat_kg * harga_jual_pengepul) as total'))
            ->first()
            ->total ?? 0;

        // Total Dana Titipan Warga: Sum of total_tabungan from users
        $totalDanaTitipanWarga = User::where('role', 'user')->sum('total_tabungan');

        // Sisa Kas Pengelola: last record of sisa_saldo_kas in cashflow_pengelola
        $sisaKasPengelola = CashflowPengelola::orderBy('id', 'desc')->first()->sisa_saldo_kas ?? 0;

        // Total berat sampah di gudang saat ini
        $totalSampahGudang = SetoranSampah::where('status', 'gudang')->sum('berat_kg');

        return view('admin.dashboard.index', compact(
            'totalNasabah',
            'nasabahBaruBulanIni',
            'totalOmsetBerjalan',
            'totalDanaTitipanWarga',
            'sisaKasPengelola',
            'totalSampahGudang'
        ));
    }
}
