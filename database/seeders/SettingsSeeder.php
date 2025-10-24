<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSettings = [
            // Grup 1: Kontak & Website
            [
                'key' => 'alamat_gereja',
                'value' => 'Jl. Raya Antan, Desa Maranatha, Kec. Ngabang, Kab. Landak, Kalimantan Barat 79356',
                'group' => 'kontak',
                'type' => 'textarea'
            ],
            [
                'key' => 'telepon_kantor',
                'value' => '(0563) 123-4567',
                'group' => 'kontak',
                'type' => 'text'
            ],
            [
                'key' => 'email_kantor',
                'value' => 'info@gppikmaranatha.org',
                'group' => 'kontak',
                'type' => 'email'
            ],
            [
                'key' => 'jam_pelayanan',
                'value' => 'Senin - Jumat, 09:00 - 15:00 WIB',
                'group' => 'kontak',
                'type' => 'text'
            ],
            [
                'key' => 'google_maps_url',
                'value' => 'https://maps.google.com/?q=GPPIK+Maranatha+Antan',
                'group' => 'kontak',
                'type' => 'url'
            ],
            [
                'key' => 'copyright_text',
                'value' => '© 2025 GPPIK Maranatha Antan. All rights reserved.',
                'group' => 'kontak',
                'type' => 'text'
            ],

            // Grup 2: Media Sosial
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/gppikmaranatha',
                'group' => 'media_sosial',
                'type' => 'url'
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/gppikmaranatha',
                'group' => 'media_sosial',
                'type' => 'url'
            ],
            [
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@gppikmaranatha',
                'group' => 'media_sosial',
                'type' => 'url'
            ],

            // Grup 3: Visual & Sistem
            [
                'key' => 'logo_website',
                'value' => null,
                'group' => 'visual',
                'type' => 'file'
            ],
            [
                'key' => 'google_analytics_code',
                'value' => null,
                'group' => 'visual',
                'type' => 'textarea'
            ],

            // Grup 4: Konten Beranda
            [
                'key' => 'welcome_label',
                'value' => 'Welcome',
                'group' => 'beranda',
                'type' => 'text'
            ],
            [
                'key' => 'main_title',
                'value' => 'GPPIK Maranatha Antan',
                'group' => 'beranda',
                'type' => 'text'
            ],
            [
                'key' => 'main_subtitle',
                'value' => 'GEREJA PROTESTAN PERJANJIAN BARU INDONESIA KAWASAN MARANATHA ANTAN',
                'group' => 'beranda',
                'type' => 'text'
            ],
            [
                'key' => 'intro_text',
                'value' => 'Selamat datang di website resmi GPPIK Maranatha Antan. Kami adalah komunitas iman yang berdedikasi untuk melayani Tuhan dan sesama dengan kasih. Bergabunglah bersama kami dalam perjalanan rohani yang penuh berkat.',
                'group' => 'beranda',
                'type' => 'textarea'
            ],
            [
                'key' => 'cta_button_text',
                'value' => 'Lihat Visi, Misi, dan Sejarah Gereja',
                'group' => 'beranda',
                'type' => 'text'
            ],
            [
                'key' => 'cta_button_url',
                'value' => '#profil-lengkap',
                'group' => 'beranda',
                'type' => 'text'
            ],
            [
                'key' => 'hero_image',
                'value' => null,
                'group' => 'beranda',
                'type' => 'file'
            ],
            [
                'key' => 'show_bible_verses',
                'value' => '1',
                'group' => 'beranda',
                'type' => 'checkbox'
            ],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('✓ Default settings created successfully!');
    }
}
