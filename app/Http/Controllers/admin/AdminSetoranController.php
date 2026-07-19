<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SetoranSampah;
use App\Models\HargaSampah;
use App\Models\TransaksiKeuanganNasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSetoranController extends Controller
{
    /**
     * Display setoran form and recent log.
     */
    public function index()
    {
        $hargaMaster = HargaSampah::all()->keyBy('jenis_sampah');
        $recentSetoran = SetoranSampah::with('nasabah')
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();
        $nasabahList = User::where('role', 'user')
            ->select('id', 'no_id', 'name', 'address', 'phone_number', 'profile_photo')
            ->get();

        return view('admin.setoran.index', compact('hargaMaster', 'recentSetoran', 'nasabahList'));
    }

    /**
     * Store a new setoran transaction.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_id' => ['required', 'string'],
            'jenis_sampah' => ['required', 'string', 'in:botol plastik,kardus,kaleng'],
            'berat_kg' => ['required', 'numeric', 'min:0.01'],
        ]);

        $nasabah = User::where('no_id', $request->no_id)
            ->where('role', 'user')
            ->first();

        if (!$nasabah) {
            return redirect()->back()
                ->withErrors(['no_id' => 'Nomor rekening nasabah tidak terdaftar.'])
                ->withInput();
        }

        $hargaConfig = HargaSampah::where('jenis_sampah', $request->jenis_sampah)->first();
        if (!$hargaConfig) {
            return redirect()->back()
                ->withErrors(['jenis_sampah' => 'Harga acuan untuk jenis sampah ini belum dikonfigurasi.'])
                ->withInput();
        }

        $hargaBeliNasabah = $hargaConfig->harga_beli_nasabah;
        $hargaJualPengepul = $hargaConfig->harga_jual_pengepul;
        $totalHargaNasabah = $request->berat_kg * $hargaBeliNasabah;

        DB::transaction(function () use ($nasabah, $request, $hargaBeliNasabah, $hargaJualPengepul, $totalHargaNasabah) {
            // 1. Create setoran log
            SetoranSampah::create([
                'nasabah_id' => $nasabah->id,
                'jenis_sampah' => $request->jenis_sampah,
                'berat_kg' => $request->berat_kg,
                'harga_beli_nasabah' => $hargaBeliNasabah,
                'harga_jual_pengepul' => $hargaJualPengepul,
                'total_harga_nasabah' => $totalHargaNasabah,
                'status' => 'gudang',
            ]);

            // 2. Add to user's total_tabungan
            $nasabah->increment('total_tabungan', $totalHargaNasabah);

            // 3. Log to transaksi_keuangan_nasabah
            TransaksiKeuanganNasabah::create([
                'nasabah_id' => $nasabah->id,
                'jenis_transaksi' => 'masuk',
                'nominal' => $totalHargaNasabah,
                'saldo_terakhir' => $nasabah->total_tabungan,
                'keterangan' => "Setoran sampah {$request->jenis_sampah} seberat {$request->berat_kg} kg",
            ]);
        });

        return redirect()->back()->with('success', 'Transaksi setoran sampah berhasil dicatat dan saldo tabungan nasabah telah bertambah.');
    }
}
