<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('admin')->user();

            if ($user->role === 'kades') {
                return redirect()->route('admin.arsip.index');
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Anda sudah keluar.');
    }

    // Lupa Password
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email',
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem.',
        ]);

        // Generate token
        $token = Str::random(64);

        // Hapus token lama jika ada
        DB::table('admin_password_resets')->where('email', $request->email)->delete();

        // Simpan token baru
        DB::table('admin_password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        // Kirim email
        $resetLink = route('admin.password.reset', ['token' => $token, 'email' => $request->email]);

        Mail::send('admin.auth.emails.reset-password', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password - Layanan Surat Digital');
        });

        return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
    }

    public function showResetPasswordForm($token, Request $request)
    {
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:admin,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Cek token
        $passwordReset = DB::table('admin_password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->with('error', 'Token reset password tidak valid!');
        }

        // Cek apakah token sudah kadaluarsa (1 jam)
        if (Carbon::parse($passwordReset->created_at)->addHour()->isPast()) {
            return back()->with('error', 'Token reset password sudah kadaluarsa!');
        }

        // Update password
        $admin = Admin::where('email', $request->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();

        // Hapus token
        DB::table('admin_password_resets')->where('email', $request->email)->delete();

        return redirect()->route('admin.login')->with('status', 'Password berhasil direset! Silakan login.');
    }

    // Profile & Settings
    public function showProfile()
    {
        return view('admin.profile.index');
    }

    public function updateEmail(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'email' => 'required|email|unique:admin,email,' . $admin->id,
            'current_password' => 'required',
        ], [
            'email.unique' => 'Email sudah digunakan oleh admin lain.',
            'current_password.required' => 'Password saat ini harus diisi untuk konfirmasi.',
        ]);

        // Verifikasi password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Password saat ini tidak sesuai!');
        }

        $admin->email = $request->email;
        $admin->save();

        return back()->with('success', 'Email berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed|different:current_password',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.different' => 'Password baru harus berbeda dari password lama.',
        ]);

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Password saat ini tidak sesuai!');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}
