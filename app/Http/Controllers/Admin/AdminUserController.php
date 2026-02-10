<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dibuat');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,$user->id",
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        logActivity(
            'Tambah User',
            'Menambahkan user ' . $user->name . ' sebagai ' . $user->role
        );


        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
