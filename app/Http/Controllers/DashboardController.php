<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Kegiatan::where('user_id', auth()->id())->get();
        $total = $data->count();
        return view('dashboard', compact('total'));
    }
}
