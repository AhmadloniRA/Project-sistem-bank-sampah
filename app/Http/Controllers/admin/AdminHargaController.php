<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaSampah;
use Illuminate\Http\Request;

class AdminHargaController extends Controller
{
    /**
     * Display current trash price configurations.
     */
    public function index()
    {
        $hargaList = HargaSampah::all();
        return view('admin.harga.index', compact('hargaList'));
    }

    /**
     * Update the price configuration.
     */
    public function update(Request $request, HargaSampah $harga)
    {
        $request->validate([
            'harga_beli_nasabah' => ['required', 'integer', 'min:0'],
            'harga_jual_pengepul' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->harga_jual_pengepul < $request->harga_beli_nasabah) {
            return redirect()->back()
                ->withErrors(['harga_jual_pengepul' => 'Harga jual pengepul tidak boleh lebih kecil daripada harga beli nasabah (margin harus positif).'])
                ->withInput();
        }

        $harga->update([
            'harga_beli_nasabah' => $request->harga_beli_nasabah,
            'harga_jual_pengepul' => $request->harga_jual_pengepul,
        ]);

        return redirect()->back()->with('success', 'Konfigurasi master harga ' . $harga->jenis_sampah . ' berhasil diperbarui.');
    }
}
