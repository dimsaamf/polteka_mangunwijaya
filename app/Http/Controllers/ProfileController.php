<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function EditProfilePicSuperadmin()
    {
        return view('rolesuperadmin.contentsuperadmin.ubahprofil');
    }

    public function EditProfilePicture(Request $request)
{
    $request->validate([
        'avatar' => 'required|image',
    ]);

    $avatar = $request->file('avatar');
    $avatarName = $avatar->getClientOriginalName();
    $avatar->move(public_path('avatars'), $avatarName);
    $userId = Auth::id();
    User::where('id', $userId)->update(['avatar' => $avatarName]);

    return back()->with('success', 'Avatar updated successfully.');
}


    public function getAvatar($filename)
{
    $user = User::where('avatar', $filename)->firstOrFail();
    return response()->file(public_path('Image/' . $filename));
}

    public function ChangePassword()
    {
        return view('rolesuperadmin.contentsuperadmin.ubahpassword');
    }

    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            
            return redirect()->back();
        } else {
           
            return redirect()->back();
        }
    }
}
