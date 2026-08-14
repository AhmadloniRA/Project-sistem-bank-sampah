<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nasabah = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        $totalNasabah = $nasabah->count();
        $nasabahBaruBulanIni = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('admin.nasabah.index', compact('nasabah', 'totalNasabah', 'nasabahBaruBulanIni'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah terdaftar.',
            'phone_number.max' => 'Nomor HP maksimal 15 karakter.',
            'kk_number.required' => 'Nomor KK wajib diisi.',
            'kk_number.size' => 'Nomor KK harus 16 digit.',
            'kk_number.unique' => 'Nomor KK sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'kk_number' => ['required', 'string', 'size:16', 'unique:users'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ], $messages);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'kk_number' => $request->kk_number,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'total_tabungan' => 0,
        ]);

        return redirect()->back()->with('success', 'Nasabah baru berhasil terdaftar.');
    }

    /**
     * Display financial transaction history for the nasabah.
     */
    public function history(User $nasabah)
    {
        $transactions = $nasabah->transaksiKeuangan()->orderBy('created_at', 'desc')->get();
        return view('admin.nasabah.history', compact('nasabah', 'transactions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $nasabah)
    {
        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah terdaftar untuk nasabah lain.',
            'phone_number.max' => 'Nomor HP maksimal 15 karakter.',
            'kk_number.required' => 'Nomor KK wajib diisi.',
            'kk_number.size' => 'Nomor KK harus 16 digit.',
            'kk_number.unique' => 'Nomor KK sudah terdaftar untuk nasabah lain.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($nasabah->id)],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'kk_number' => ['required', 'string', 'size:16', Rule::unique('users')->ignore($nasabah->id)],
            'address' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8'],
        ], $messages);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'kk_number' => $request->kk_number,
            'address' => $request->address,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $nasabah->update($data);

        return redirect()->back()->with('success', 'Data nasabah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $nasabah)
    {
        $nasabah->delete();
        return redirect()->back()->with('success', 'Nasabah berhasil dihapus.');
    }
}
