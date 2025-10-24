<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view): void
    {
        $settings = Setting::getAllSettings();
        
        $view->with('siteSettings', $settings);
    }
}
