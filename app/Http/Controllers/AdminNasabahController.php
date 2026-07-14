<?php

namespace App\Http\Controllers;

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
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $nasabah)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($nasabah->id)],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'kk_number' => ['required', 'string', 'size:16', Rule::unique('users')->ignore($nasabah->id)],
            'address' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

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
