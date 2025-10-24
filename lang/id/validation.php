<?php

return [
    'max' => [
        'numeric' => ':attribute tidak boleh lebih besar dari :max.',
        'file' => ':attribute tidak boleh lebih besar dari :max kilobytes.',
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
        'array' => ':attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berupa file bertipe: :values.',
    
    'custom' => [
        'favicon' => [
            'mimes' => 'Favicon harus berformat .jpg atau .png',
            'image' => 'File yang diupload harus berupa gambar',
        ],
        'logo_website' => [
            'mimes' => 'Logo harus berformat .jpg atau .png',
            'image' => 'File yang diupload harus berupa gambar',
        ],
    ],

    'attributes' => [
        'favicon' => 'Favicon',
        'logo_website' => 'Logo Website',
        'alamat_gereja' => 'Alamat Gereja',
        'telepon_kantor' => 'Telepon Kantor',
        'email_kantor' => 'Email Kantor',
        'jam_pelayanan' => 'Jam Pelayanan',
        'google_maps_url' => 'URL Google Maps',
        'copyright_text' => 'Teks Copyright',
        'facebook_url' => 'URL Facebook',
        'instagram_url' => 'URL Instagram', 
        'youtube_url' => 'URL YouTube',
        'google_analytics_code' => 'Kode Google Analytics',
        'ayat_alkitab_1_ref' => 'Referensi Ayat Alkitab 1',
        'ayat_alkitab_1_text' => 'Teks Ayat Alkitab 1',
        'ayat_alkitab_2_ref' => 'Referensi Ayat Alkitab 2',
        'ayat_alkitab_2_text' => 'Teks Ayat Alkitab 2',
    ],
];