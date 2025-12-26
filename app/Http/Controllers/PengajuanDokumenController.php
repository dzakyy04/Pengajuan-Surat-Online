<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PengajuanDokumenController extends Controller
{
    public function view(Request $request, PengajuanSurat $pengajuan)
    {
        $file = $request->query('file');

        $this->authorizeFile($pengajuan, $file);

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        // tampilkan langsung (inline)
        return response()->file(Storage::disk('public')->path($file));
    }

    public function download(Request $request, PengajuanSurat $pengajuan)
    {
        $file = $request->query('file');

        $this->authorizeFile($pengajuan, $file);

        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }

        return Storage::disk('public')->download($file);
    }

    private function authorizeFile(PengajuanSurat $pengajuan, ?string $file): void
    {
        if (!$file) abort(400);

        // hanya izinkan 3 file yang memang milik pengajuan ini
        $allowed = [
            $pengajuan->dokumen_ktp,
            $pengajuan->dokumen_kk,
            $pengajuan->dokumen_surat_rt,
        ];

        if (!in_array($file, $allowed, true)) {
            abort(Response::HTTP_FORBIDDEN);
        }
    }
}
