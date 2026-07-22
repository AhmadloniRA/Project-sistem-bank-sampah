<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminSettingsController extends Controller
{
    /**
     * Display admin settings and profile page.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings.index', compact('admin'));
    }

    /**
     * Update admin profile details.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
            'phone_number' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama administrator wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'profile_photo.image' => 'File foto profil harus berupa gambar.',
            'profile_photo.max' => 'Ukuran foto profil maksimal 2MB.',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_admin_' . $admin->id . '.' . $file->getClientOriginalExtension();
            $uploadDir = public_path('uploads/avatars/admin');

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if ($admin->profile_photo && file_exists(public_path($admin->profile_photo))) {
                @unlink(public_path($admin->profile_photo));
            }

            $file->move($uploadDir, $filename);
            $admin->profile_photo = 'uploads/avatars/admin/' . $filename;
        }

        $admin->save();

        return redirect()->route('admin.settings')->with('success', 'Profil admin berhasil diperbarui!');
    }

    /**
     * Update admin password.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal harus 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->with('error', 'Password saat ini yang Anda masukkan salah!');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.settings')->with('success', 'Password admin berhasil diperbarui!');
    }
}
