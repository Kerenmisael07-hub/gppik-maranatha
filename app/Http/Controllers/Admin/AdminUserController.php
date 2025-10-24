<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);
        return view('admin.manajemen.index', compact('users'));
    }

    public function create()
    {
        return view('admin.manajemen.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.manajemen_admin')->with('success','Admin dibuat.');
    }

    public function edit(User $user)
    {
        return view('admin.manajemen.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $user->update($data);
        return redirect()->route('admin.manajemen_admin')->with('success','Admin diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.manajemen_admin')->with('success','Admin dihapus.');
    }
}
