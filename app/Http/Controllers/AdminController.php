<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
 
    /*
     * After logging as client the dashboard for client
     * @return \Illuminate\Contracts\Support\Referable
     * */
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
