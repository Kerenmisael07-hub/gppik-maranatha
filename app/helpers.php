<?php

if (!function_exists('site_logo')) {
    /**
     * Get site logo URL
     * 
     * @return string
     */
    function site_logo()
    {
        try {
            $logoPath = \App\Models\Setting::get('logo_website');
            if ($logoPath) {
                return asset('storage/' . $logoPath);
            }
        } catch (\Exception $e) {
            // Silently fail if settings table doesn't exist
        }
        
        return asset('img/Gereja.jpg');
    }
}

if (!function_exists('admin_logo')) {
    /**
     * Get admin panel logo URL
     * 
     * @return string
     */
    function admin_logo()
    {
        try {
            $logoPath = \App\Models\Setting::get('admin_logo');
            if ($logoPath && \Storage::disk('public')->exists($logoPath)) {
                return asset('storage/' . $logoPath);
            }
        } catch (\Exception $e) {
            // Silently fail and use site logo instead
        }
        
        return site_logo();
    }
}

if (!function_exists('site_setting')) {
    /**
     * Get site setting value
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function site_setting($key, $default = null)
    {
        try {
            return \App\Models\Setting::get($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }
}
