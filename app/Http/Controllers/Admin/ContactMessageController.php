<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = ContactMessage::where('is_read', false)->count();
        
        return view('admin.contact_messages.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }
        
        return view('admin.contact_messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact_messages.index')
            ->with('success', 'Pesan berhasil dihapus');
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return back()->with('success', 'Pesan ditandai sudah dibaca');
    }

    public function markAsReplied(ContactMessage $contactMessage)
    {
        $contactMessage->update(['replied_at' => now()]);
        return back()->with('success', 'Pesan ditandai sudah dibalas');
    }
}
