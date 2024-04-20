<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Flash;

class SesiController extends Controller
{
    public function index(){
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'superadmin'){
                return redirect('/superadmin/manajemenuser');
            } elseif(Auth::user()->role == 'wakildirektur'){
                return redirect('/daswadir');
            }
        }
        return view('login');
    }
    
    public function login(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
    
        $infologin = [
            'name' => $request->name,
            'password' => $request->password,
        ];
    
        if(Auth::attempt($infologin)){
            $request->session()->regenerate();
            Alert::success('Data Sistem', 'Berhasil Login');
            $request->session()->put('is_logged_in', true);
    
            if(Auth::user()->role == 'superadmin'){
                return redirect('/superadmin/manajemenuser');
            } elseif(Auth::user()->role == 'wakildirektur'){
                return redirect('/daswadir');
            }
        } else {
            return redirect('/login')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }
    
    

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
