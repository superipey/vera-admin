<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['pelanggaran'] = \App\Pelanggaran::orderBy('created_at')->get();
        return view('dashboard', $data);
    }
}
