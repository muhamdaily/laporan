<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $total = Kegiatan::count();

        return view('user.index', compact('total'));
    }
}
