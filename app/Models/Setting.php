<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'pengaturans';
    protected $fillable = ['key', 'value', 'group', 'type'];

    /**
     * Mendapatkan nilai pengaturan berdasarkan key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        try {
            // Gunakan cache untuk performa lebih baik
            return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
                $setting = self::where('key', $key)->first();
                return $setting && $setting->value ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Menyimpan atau update nilai pengaturan
     * 
     * @param string $key
     * @param mixed $value
     * @param string|null $group
     * @param string $type
     * @return void
     */
    public static function set(string $key, $value, ?string $group = null, string $type = 'text')
    {
        $data = [
            'value' => is_array($value) ? json_encode($value) : (string)$value,
            'type' => $type
        ];
        
        if (!is_null($group)) {
            $data['group'] = $group;
        }

        self::updateOrCreate(['key' => $key], $data);

        // Clear cache setelah update
        Cache::forget("setting_{$key}");
    }

    /**
     * Mendapatkan semua pengaturan berdasarkan grup
     * 
     * @param string $group
     * @return \Illuminate\Support\Collection
     */
    public static function getByGroup(string $group)
    {
        return self::where('group', $group)->pluck('value', 'key');
    }

    /**
     * Mendapatkan semua pengaturan dalam format key-value
     * 
     * @return array
     */
    public static function getAllSettings()
    {
        return Cache::remember('all_settings', 3600, function () {
            return self::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear semua cache pengaturan
     */
    public static function clearCache()
    {
        Cache::forget('all_settings');
        // Juga bisa clear cache individual jika diketahui key-nya
    }
}
