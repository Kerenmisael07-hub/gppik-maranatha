<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class PengaturanUmumController extends Controller
{
    /**
     * Menampilkan halaman pengaturan umum
     */
    public function index()
    {
        // Ambil semua pengaturan yang ada
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.pengaturan.index', compact('settings'));
    }

    /**
     * Menyimpan semua pengaturan
     */
    public function update(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            // Grup 1: Kontak & Website
            'alamat_gereja' => 'required|string|max:500',
            'telepon_kantor' => 'nullable|string|max:50',
            'email_kantor' => 'nullable|email|max:100',
            'jam_pelayanan' => 'nullable|string|max:200',
            'google_maps_url' => 'nullable|url|max:500',
            'copyright_text' => 'nullable|string|max:200',
            'show_bible_verses' => 'required|in:0,1',
            'ayat_alkitab_1_ref' => 'nullable|string|max:100',
            'ayat_alkitab_1_text' => 'nullable|string|max:500',
            'ayat_alkitab_2_ref' => 'nullable|string|max:100',
            'ayat_alkitab_2_text' => 'nullable|string|max:500',

            // Grup 2: Media Sosial
            'facebook_url' => 'nullable|url|max:200',
            'instagram_url' => 'nullable|url|max:200',
            'youtube_url' => 'nullable|url|max:200',

            // Grup 3: Visual & Sistem
            'logo_website' => 'nullable|image|mimes:jpeg,png',
            'favicon' => 'nullable|image|mimes:jpeg,png',
            'google_analytics_code' => 'nullable|string|max:1000',
        ]);

        // Simpan pengaturan Grup 1: Kontak & Website
        Setting::set('alamat_gereja', $validated['alamat_gereja'], 'kontak', 'textarea');
        Setting::set('telepon_kantor', $validated['telepon_kantor'], 'kontak', 'text');
        Setting::set('email_kantor', $validated['email_kantor'], 'kontak', 'email');
        Setting::set('jam_pelayanan', $validated['jam_pelayanan'], 'kontak', 'text');
        Setting::set('google_maps_url', $validated['google_maps_url'], 'kontak', 'url');
        Setting::set('copyright_text', $validated['copyright_text'], 'kontak', 'text');
        Setting::set('show_bible_verses', $validated['show_bible_verses'], 'kontak', 'boolean');
        Setting::set('ayat_alkitab_1_ref', $validated['ayat_alkitab_1_ref'], 'kontak', 'text');
        Setting::set('ayat_alkitab_1_text', $validated['ayat_alkitab_1_text'], 'kontak', 'textarea');
        Setting::set('ayat_alkitab_2_ref', $validated['ayat_alkitab_2_ref'], 'kontak', 'text');
        Setting::set('ayat_alkitab_2_text', $validated['ayat_alkitab_2_text'], 'kontak', 'textarea');

        // Simpan pengaturan Grup 2: Media Sosial
        Setting::set('facebook_url', $validated['facebook_url'], 'media_sosial', 'url');
        Setting::set('instagram_url', $validated['instagram_url'], 'media_sosial', 'url');
        Setting::set('youtube_url', $validated['youtube_url'], 'media_sosial', 'url');

        // Simpan pengaturan Grup 3: Visual & Sistem
        if ($request->hasFile('logo_website')) {
            // Hapus logo lama jika ada
            $oldLogo = Setting::get('logo_website');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Simpan logo baru
            $logoPath = $request->file('logo_website')->store('logo', 'public');
            Setting::set('logo_website', $logoPath, 'visual', 'file');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Hapus favicon lama jika ada
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            // Simpan favicon baru
            $faviconPath = $request->file('favicon')->store('logo', 'public');
            Setting::set('favicon', $faviconPath, 'visual', 'file');
        }

        Setting::set('google_analytics_code', $validated['google_analytics_code'], 'visual', 'textarea');

        // Clear cache pengaturan
        Setting::clearCache();

        return redirect()->route('admin.pengaturan_umum')
            ->with('success', 'Pengaturan berhasil disimpan! Perubahan akan terlihat di seluruh website.');
    }
}
