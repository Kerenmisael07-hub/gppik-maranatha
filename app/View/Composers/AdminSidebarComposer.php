<?php

namespace App\View\Composers;

use App\Models\ContactMessage;
use Illuminate\View\View;

class AdminSidebarComposer
{
    public function compose(View $view): void
    {
        $unreadMessagesCount = 0;
        
        try {
            $unreadMessagesCount = ContactMessage::where('is_read', false)->count();
        } catch (\Exception $e) {
            // Silently fail if table doesn't exist
        }
        
        $view->with('unreadMessagesCount', $unreadMessagesCount);
    }
}
