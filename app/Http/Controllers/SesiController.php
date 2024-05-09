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
                return redirect('/wakildirektur/dashboard');
            } elseif(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect('/koorlabfarmasi/dashboard');
            } elseif(Auth::user()->role == 'koorlabprodankes'){
                return redirect('/koorlabankes/dashboard');
            } elseif(Auth::user()->role == 'koorlabprodkimia'){
                return redirect('/koorlabkimia/dashboard');
            } elseif(Auth::user()->role == 'adminlabprodankes'){
                return redirect('/adminlabankes/dashboard');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect('/adminlabkimia/dashboard');
            } elseif(Auth::user()->role == 'adminprodfarmasi'){
                return redirect('/adminprodifarmasi/dashboard');
            } elseif(Auth::user()->role == 'adminprodankes'){
                return redirect('/adminprodiankes/dashboard');
            } elseif(Auth::user()->role == 'adminprodkimia'){
                return redirect('/adminprodikimia/dashboard');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return redirect('/adminlabfarmasi/dashboard');
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
                return redirect('/wakildirektur/dashboard');
            } elseif(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect('/koorlabfarmasi/dashboard');
            } elseif(Auth::user()->role == 'koorlabprodankes'){
                return redirect('/koorlabankes/dashboard');
            } elseif(Auth::user()->role == 'koorlabprodkimia'){
                return redirect('/koorlabkimia/dashboard');
            } elseif(Auth::user()->role == 'adminlabprodankes'){
                return redirect('/adminlabankes/dashboard');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect('/adminlabkimia/dashboard');
            } elseif(Auth::user()->role == 'adminprodfarmasi'){
                return redirect('/adminprodifarmasi/dashboard');
            } elseif(Auth::user()->role == 'adminprodankes'){
                return redirect('/adminprodiankes/dashboard');
            } elseif(Auth::user()->role == 'adminprodkimia'){
                return redirect('/adminprodikimia/dashboard');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return redirect('/adminlabfarmasi/dashboard');
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
        Alert::success('Data Sistem', 'Berhasil Logout');

        return redirect('/login');
    }
}
