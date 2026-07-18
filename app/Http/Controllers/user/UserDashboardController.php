<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display user personal savings dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Total weight of waste this user has deposited
        $totalTimbangan = $user->setoranSampah()->sum('berat_kg');

        // Recent transaction history
        $transactions = $user->transaksiKeuangan()
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return view('user.dashboard', compact('user', 'totalTimbangan', 'transactions'));
    }

    /**
     * Display full transaction history for the user.
     */
    public function riwayat()
    {
        $user = Auth::user();

        $transactions = $user->transaksiKeuangan()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalMasuk  = $user->transaksiKeuangan()->where('jenis_transaksi', 'masuk')->sum('nominal');
        $totalKeluar = $user->transaksiKeuangan()->where('jenis_transaksi', 'keluar')->sum('nominal');

        return view('user.riwayat', compact('user', 'transactions', 'totalMasuk', 'totalKeluar'));
    }

    /**
     * Display user profile page.
     */
    public function profil()
    {
        $user = Auth::user();

        $totalTimbangan  = $user->setoranSampah()->sum('berat_kg');
        $totalTransaksi  = $user->transaksiKeuangan()->count();

        return view('user.profil', compact('user', 'totalTimbangan', 'totalTransaksi'));
    }
}