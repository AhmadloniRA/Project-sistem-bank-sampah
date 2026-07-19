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

    /**
     * Update user profile details and verification fields.
     */
    public function updateProfil(\Illuminate\Http\Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            
            // Ensure folder exists
            if (!file_exists(public_path('uploads/avatars'))) {
                mkdir(public_path('uploads/avatars'), 0777, true);
            }
            
            // Delete old photo if exists
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                @unlink(public_path($user->profile_photo));
            }

            $file->move(public_path('uploads/avatars'), $filename);
            $user->profile_photo = 'uploads/avatars/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui dan diverifikasi!');
    }
}