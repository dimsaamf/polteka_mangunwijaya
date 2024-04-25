<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWadirController extends Controller
{
    public function index(){
        return view('rolewadir.contentwadir.dashboard');
    }
}
