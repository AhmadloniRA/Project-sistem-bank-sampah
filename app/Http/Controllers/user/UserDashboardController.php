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
}