<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardWadirController extends Controller
{
    public function index(){
        return view('rolewadir.contentwadir.dashboard');
    }
}
