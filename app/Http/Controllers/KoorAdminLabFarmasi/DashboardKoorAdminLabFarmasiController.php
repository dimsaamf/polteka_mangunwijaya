<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardKoorAdminLabFarmasiController extends Controller
{
    public function index(){
        return view('rolekoorlabfarmasi.contentkoorlab.dashboard');
    }
}
