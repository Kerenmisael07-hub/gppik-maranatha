<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nyanyian;
use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('pemilikgereja435'),
            ]
        );

        // Default profile content
        Pengaturan::updateOrCreate(
            ['key' => 'profile_content'],
            ['value' => '<h4>Visi :</h4><p class="lead">Menjadi Gereja yang Missioner dan Mandiri</p>']
        );

        // Sample songs dengan struktur baru
        if (!Nyanyian::exists()) {
            $sampleSongs = [
                [
                    'nomor_lagu' => 'KJ 1',
                    'judul_lagu' => 'Nama Yesus Terus Bersuara',
                    'kategori' => 'Pujian',
                    'sumber_buku' => 'KJ',
                    'lirik' => "Nama Yesus terus bersuara\nDi telinga orang berdosa\nNama Yesus mengubah dunia\nBagi orang yang percaya\n\nNama Yesus sumber sentosa\nBagi orang yang menderita\nNama Yesus kuasa yang baka\nBagi orang yang percaya",
                    'status' => 1,
                ],
                [
                    'nomor_lagu' => 'PKJ 2',
                    'judul_lagu' => 'Yesus Kekasihku',
                    'kategori' => 'Penyembahan',
                    'sumber_buku' => 'PKJ',
                    'lirik' => "Yesus kekasihku\nAnak domba Allah\nKuasamu dan kudusMu sempurna\nDalam kasihMu hidupku s'lamanya\nYesus kekasihku",
                    'status' => 1,
                ],
                [
                    'nomor_lagu' => 'NKB 50',
                    'judul_lagu' => 'Syukur Pada Tuhan',
                    'kategori' => 'Ucapan Syukur',
                    'sumber_buku' => 'NKB',
                    'lirik' => "Syukur pada Tuhan yang memberi berkat\nHati yang penuh syukur bernyanyi s'lamanya\nSyukur kepada Tuhan atas anugrahNya\nHati yang penuh syukur bernyanyi s'lamanya",
                    'status' => 1,
                ],
            ];

            foreach ($sampleSongs as $song) {
                Nyanyian::create($song);
            }
        }
    }
}
