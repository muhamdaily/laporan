<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Kegiatan::where('user_id', auth()->id())->get();
        $total = $data->count();
        return view('laporan.index', compact('total'));
    }

    public function filter(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;

        $kegiatans = Kegiatan::whereBetween('tanggal', [$dari_tanggal, $sampai_tanggal])
            ->get();

        return response()->json([
            'kegiatans' => $kegiatans
        ]);
    }

    public function cetakPdf(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;

        $kegiatans = Kegiatan::whereBetween('tanggal', [$dari_tanggal, $sampai_tanggal])
            ->get();

        $pdf = PDF::loadView('laporan.cetak', compact('kegiatans', 'dari_tanggal', 'sampai_tanggal'))->setPaper('a4', 'portrait');

        $uid = uniqid();
        $format = 'laporan-kegiatan_' . auth()->user()->nim . '_' . $uid;

        return $pdf->download($format . '.pdf');
    }
}
