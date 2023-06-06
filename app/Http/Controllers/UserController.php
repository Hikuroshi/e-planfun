<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'title' => 'Daftar User',
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.create', [
            'title' => 'Tambah User',
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:100',
            'username' => 'required|min:3|max:30|alpha_dash|unique:users',
            'password' => ['required', 'confirmed', Password::min(5)->letters()->numbers()],
            'role_id' => 'required',
        ]);

        $validatedData['nama'] = ucwords($request->nama);
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);
        return redirect('/dashboard/users')->with('success', 'User berhasil ditambahkan!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', [
            'title' => 'Tambah User',
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama' => 'required|max:100',
            'role_id' => 'required',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:30|alpha_dash|unique:users';
        }

        $validatedData = $request->validate($rules);
        $validatedData['nama'] = ucwords($request->nama);

        User::where('id', $user->id)->update($validatedData);
        return redirect('/dashboard/users')->with('success', 'User berhasil perbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('success', 'User berhasil dihapus!');
    }

    public function editPassword(User $user)
    {
        return view('dashboard.user.edit-password', [
            'title' => 'Perbarui password User',
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => ['required', 'confirmed', Password::min(5)->letters()->numbers()],
        ]);

        $validatedData['password'] = Hash::make($request->password);

        User::where('id', $user->id)->update($validatedData);
        return redirect('/dashboard/users')->with('success', 'Password user berhasil perbarui!');
    }
}
