<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }
}