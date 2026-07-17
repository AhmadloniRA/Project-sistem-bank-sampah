<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TransaksiKeuanganNasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPenarikanController extends Controller
{
    /**
     * Display search and penarikan form.
     */
    public function index(Request $request)
    {
        $nasabah = null;
        $searchNoId = $request->get('no_id');

        if ($searchNoId) {
            $nasabah = User::where('no_id', $searchNoId)
                ->where('role', 'user')
                ->first();

            if (!$nasabah) {
                return redirect()->route('admin.penarikan')
                    ->withErrors(['no_id' => 'Nomor rekening nasabah tidak ditemukan.']);
            }
        }

        return view('admin.penarikan.index', compact('nasabah'));
    }

    /**
     * Store a withdrawal transaction.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => ['required', 'integer', 'exists:users,id'],
            'nominal' => ['required', 'integer', 'min:100'],
        ]);

        $nasabah = User::findOrFail($request->nasabah_id);

        if ($nasabah->total_tabungan < $request->nominal) {
            return redirect()->back()
                ->withErrors(['nominal' => 'Saldo tabungan nasabah tidak mencukupi untuk melakukan penarikan ini.'])
                ->withInput();
        }

        DB::transaction(function () use ($nasabah, $request) {
            // 1. Deduct user total_tabungan
            $nasabah->decrement('total_tabungan', $request->nominal);

            // 2. Log financial transaction
            TransaksiKeuanganNasabah::create([
                'nasabah_id' => $nasabah->id,
                'jenis_transaksi' => 'keluar',
                'nominal' => $request->nominal,
                'saldo_terakhir' => $nasabah->total_tabungan,
                'keterangan' => 'Penarikan tunai saldo tabungan warga di loket',
            ]);
        });

        return redirect()->route('admin.penarikan')->with('success', 'Penarikan tunai berhasil diproses! Saldo nasabah telah dipotong.');
    }
}
