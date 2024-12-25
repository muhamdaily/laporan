<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = Kegiatan::all();
        $total = Kegiatan::count();
        return view('kegiatan.index', compact('data', 'total'));
    }

    public function show($kegiatan)
    {
        $data = Kegiatan::find($kegiatan);
        $total = Kegiatan::count();
        return view('kegiatan.show', compact('data', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'uraian_kegiatan' => 'required|string',
            'hasil_kegiatan' => 'required|string',
            'kendala' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf,docx,xlsx,pptx,jpg,jpeg,png,gif,zip,rar|max:10240',
        ]);

        $kegiatan = Kegiatan::create([
            'tanggal' => $request->tanggal,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'hasil_kegiatan' => $request->hasil_kegiatan,
            'kendala' => $request->kendala,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $uid = uniqid();
                $format = 'dokumen-pendukung-' . now()->format('d-F-Y') . '-' . $uid;
                $filename = $format . '.' . $file->getClientOriginalExtension();
                $file->storeAs('files', $filename, 'public');

                File::create([
                    'kegiatan_id' => $kegiatan->id,
                    'file_name' => $filename,
                    'file_path' => 'files/' . $filename,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return back()->with('success', 'Kegiatan berhasil disimpan!');
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'uraian_kegiatan' => 'required|string',
            'hasil_kegiatan' => 'required|string',
            'kendala' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:pdf,docx,xlsx,pptx,jpg,jpeg,png,gif,zip,rar|max:10240',
        ]);

        $kegiatan->update([
            'tanggal' => $request->tanggal,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'hasil_kegiatan' => $request->hasil_kegiatan,
            'kendala' => $request->kendala,
        ]);

        if ($request->hasFile('files')) {
            foreach ($kegiatan->files as $file) {
                Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }

            foreach ($request->file('files') as $file) {
                $uid = uniqid();
                $format = 'dokumen-pendukung-' . now()->format('d-F-Y') . '-' . $uid;
                $filename = $format . '.' . $file->getClientOriginalExtension();
                $file->storeAs('files', $filename, 'public');

                File::create([
                    'kegiatan_id' => $kegiatan->id,
                    'file_name' => $filename,
                    'file_path' => 'files/' . $filename,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return back()->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        foreach ($kegiatan->files as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $kegiatan->delete();

        return back()->with('success', 'Kegiatan dan file terkait berhasil dihapus!');
    }
}
