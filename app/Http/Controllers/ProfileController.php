<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller
{
    public function EditProfilePic()
    {
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'superadmin'){
                return view('rolesuperadmin.contentsuperadmin.ubahprofil');
            } elseif(Auth::user()->role == 'wakildirektur'){
                return view('rolewadir.contentwadir.ubahpp');
            } elseif(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.ubahprofil');
            } elseif(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.ubahprofil');
            } elseif(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.ubahprofil');
            } elseif(Auth::user()->role == 'adminlabprodankes'){
                return view('roleadminlabankes.contentadminlab.ubahprofil');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return view('roleadminlabfarmasi.contentadminlab.ubahprofil');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return view('roleadminlabkimia.contentadminlab.ubahprofil');
            } elseif(Auth::user()->role == 'adminprodfarmasi'){
                return view('roleadminprodifarmasi.contentadminprodi.ubahprofil');
            } elseif(Auth::user()->role == 'adminprodankes'){
                return view('roleadminprodiankes.contentadminprodi.ubahprofil');
            } elseif(Auth::user()->role == 'adminprodkimia'){
                return view('roleadminprodikimia.contentadminprodi.ubahprofil');
            }
            
        }
    }

    public function EditProfilePicture(Request $request)
    {
        $messages = [
            'avatar.image' => 'Gambar Profile harus berupa gambar.',
            'avatar.max' => 'Ukuran Gambar Profile tidak boleh melebihi 2MB.',
        ]; 

        $request->validate([
            'avatar' => 'nullable|image|max:2048',
        ], $messages);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = $avatar->getClientOriginalName();
            $avatar->move(public_path('avatars'), $avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }
        alert()->success('Berhasil', 'Gambar Profil berhasil diubah.');
        return redirect()->back();
    }


    public function getAvatar($filename)
    {
        $user = User::where('avatar', $filename)->firstOrFail();
        $avatarContent = $user->avatar;
        $contentType = 'image/jpeg';

        $headers = [
            'Content-Type' => $contentType,
        ];

        return response($avatarContent, 200, $headers);
    }


    public function ChangePassword()
    {
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'superadmin'){
                return view('rolesuperadmin.contentsuperadmin.ubahpassword');
            } elseif(Auth::user()->role == 'wakildirektur'){
                return view('rolewadir.contentwadir.ubahpassword');
            } elseif(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.ubahpassword');
            } elseif(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.ubahpassword');
            } elseif(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.ubahpassword');
            } elseif(Auth::user()->role == 'adminlabprodankes'){
                return view('roleadminlabankes.contentadminlab.ubahpassword');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return view('roleadminlabfarmasi.contentadminlab.ubahpassword');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return view('roleadminlabkimia.contentadminlab.ubahpassword');    
            } elseif(Auth::user()->role == 'adminprodfarmasi'){
                return view('roleadminprodifarmasi.contentadminprodi.ubahpassword');
            } elseif(Auth::user()->role == 'adminprodankes'){
                return view('roleadminprodiankes.contentadminprodi.ubahpassword');
            } elseif(Auth::user()->role == 'adminprodkimia'){
                return view('roleadminprodikimia.contentadminprodi.ubahpassword');
            }
        }
    }

    public function UpdatePassword(Request $request)
    {
        $messages = [
            'newpassword.min' => 'Password minimal 8 karakter.',
            'oldpassword.required' => 'Password lama diperlukan.',
            'oldpassword.incorrect' => 'Password lama salah.',
            'newpassword.required' => 'Password baru diperlukan.',
            'confirm_password.required' => 'Konfirmasi Password diperlukan.',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password baru.',
        ];

        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|string|min:8',
            'confirm_password' => 'required|same:newpassword',
        ], $messages);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = Auth::user();
            $user->password = bcrypt($request->newpassword);
            $user->save();
            
            alert()->success('Berhasil', 'Kata Sandi berhasil diubah.');
            return redirect()->back();
        } else {
            alert()->error('Gagal', 'Password Lama Salah');
            return redirect()->back();
        }
    }
}
