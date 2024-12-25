<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Kegiatan::count();
        return view('dashboard', compact('total'));
    }
}
