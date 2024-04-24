<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;


class ManajemenUserController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('search');
        $users = User::query();
    
        if ($query) {
            $users->where('name', 'like', '%'.$query.'%')
                  ->orWhere('email', 'like', '%'.$query.'%');
        }
    
        $users = $users->paginate(10);
        return view('rolesuperadmin.contentsuperadmin.manajemen', compact('users'));
    }
    
    public function create()
    {
        return view('rolesuperadmin.contentsuperadmin.tambahpengguna');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Username harus diisi.',
            'name.max' => 'username maksimal 20 karakter.',
            'name.unique' => 'Username sudah digunakan.',
            'name.regex' => 'Username tidak boleh ada spasi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus valid.',
            'email.unique' => 'Email sudah dipakai.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role harus dipilih.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.max' => 'Ukuran avatar tidak boleh melebihi 2MB.',
        ];
    
        $request->validate([
            'name' => 'required|string|max:20|unique:users|regex:/^[^\s]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:wakildirektur,superadmin,adminprodfarmasi,adminprodkimia,adminproddankes,adminlabprodfarmasi,adminlabprodkimia,adminlabprodankes,koorlabprodfarmasi,koorlabprodkimia,koorlabprodankes',
            'avatar' => 'nullable|image|max:2048',
        ], $messages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;

        if ($request->hasFile('avatar')) {
            $avatarName = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->storeAs('public/avatars', $avatarName);
            $user->avatar = $avatarName;
        }

        if ($user->avatar === null) {
            unset($user->avatar);
        }

        $user->save();

        alert()->success('Berhasil','Pengguna Baru Berhasil Ditambahkan.');
        return redirect()->route('manajemensuperadmin');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('rolesuperadmin.contentsuperadmin.editpengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.max' => 'Username maksimal 20 karakter.',
            'name.regex' => 'Username tidak boleh ada spasi.',
            'email.email' => 'Email harus valid.',
            'password.min' => 'Password minimal 8 karakter.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.max' => 'Ukuran avatar tidak boleh melebihi 2MB.',
        ];
    
        $request->validate([
            'name' => 'string|max:20|regex:/^[^\s]+$/',
            'email' => 'string|email|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'in:wakildirektur,superadmin,adminprodfarmasi,adminprodkimia,adminproddankes,adminlabprodfarmasi,adminlabprodkimia,adminlabprodankes,koorlabprodfarmasi,koorlabprodkimia,koorlabprodankes',
            'avatar' => 'nullable|image|max:2048',
        ], $messages);
    
        $user = User::findOrFail($id);

        $isUpdated = false;
        if ($user->name !== $request->name) {
            $user->name = $request->name;
            $isUpdated = true;
        }
        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $isUpdated = true;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $isUpdated = true;
        }
        if ($user->role !== $request->role) {
            $user->role = $request->role;
            $isUpdated = true;
        }
        if ($request->hasFile('avatar')) {
            $avatarName = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->storeAs('public/avatars', $avatarName);
            $user->avatar = $avatarName;
            $isUpdated = true;
        }

        if (!$isUpdated) {
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            return redirect()->route('manajemensuperadmin');
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        alert()->success('Berhasil', 'Pengguna berhasil diperbarui.');
        return redirect()->route('manajemensuperadmin');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        alert()->success('Berhasil', 'Pengguna berhasil dihapus.');
        return redirect()->route('manajemensuperadmin');
    }
}
