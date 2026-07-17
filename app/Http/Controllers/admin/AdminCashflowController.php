<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashflowPengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCashflowController extends Controller
{
    /**
     * Display cashflow table and manual input form.
     */
    public function index()
    {
        $cashflows = CashflowPengelola::orderBy('created_at', 'desc')->get();
        $sisaSaldo = CashflowPengelola::orderBy('id', 'desc')->first()->sisa_saldo_kas ?? 0;

        return view('admin.cashflow.index', compact('cashflows', 'sisaSaldo'));
    }

    /**
     * Store manual cashflow entry (usually keluar for operational expenses).
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_aliran' => ['required', 'string', 'in:masuk,keluar'],
            'nominal' => ['required', 'integer', 'min:100'],
            'kategori' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string'],
        ]);

        DB::transaction(function () use ($request) {
            $lastCashflow = CashflowPengelola::orderBy('id', 'desc')->first();
            $lastSaldo = $lastCashflow ? $lastCashflow->sisa_saldo_kas : 0;

            if ($request->jenis_aliran === 'masuk') {
                $newSaldo = $lastSaldo + $request->nominal;
            } else {
                $newSaldo = $lastSaldo - $request->nominal;
            }

            CashflowPengelola::create([
                'jenis_aliran' => $request->jenis_aliran,
                'nominal' => $request->nominal,
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan,
                'sisa_saldo_kas' => $newSaldo,
            ]);
        });

        return redirect()->back()->with('success', 'Catatan kas internal pengelola berhasil ditambahkan.');
    }
}
