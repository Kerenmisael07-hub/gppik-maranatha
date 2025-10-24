<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\ChurchProfile;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        // Ambil data dari ChurchProfile (untuk backward compatibility)
        $profile = ChurchProfile::first();
        
        // Ambil data dari Settings (prioritas utama)
        $settings = Setting::getAllSettings();
        
        return view('public.kontak', compact('profile', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan wajib diisi',
            'message.min' => 'Pesan minimal 10 karakter'
        ]);

        try {
            // Simpan ke database
            ContactMessage::create($validated);

            // Optional: Kirim email notifikasi ke admin
            // $adminEmail = Setting::get('email_kantor', 'admin@gppik.org');
            // Mail::to($adminEmail)->send(new ContactMessageReceived($validated));

            return back()->with('success', 'Pesan Anda telah berhasil terkirim. Kami akan segera menghubungi Anda. Terima kasih.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Mohon coba lagi nanti.')->withInput();
        }
    }
}
