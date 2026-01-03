<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanSurat::with(['jenisSurat', 'admin']); // Tampilkan semua data

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_pengajuan', 'like', "%{$search}%")
                    ->orWhere('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('nama_pemohon', 'like', "%{$search}%")
                    ->orWhere('email_pemohon', 'like', "%{$search}%")
                    ->orWhere('no_hp_pemohon', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat_id', $request->jenis_surat);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        $pengajuan = $query->orderBy('created_at', 'desc')->paginate(15);

        $jenisSurat = JenisSurat::all();

        return view('admin.arsip.index', compact('pengajuan', 'jenisSurat'));
    }

    public function show($id)
    {

        $pengajuan = PengajuanSurat::with([
            'jenisSurat',
            'admin',
            'suratTidakMampu',
            'suratKeteranganDomisili',
            'suratKeteranganUsaha',
            'suratKematian',
            'suratPenghasilan'
        ])->findOrFail($id);

        $detailSurat = null;
        $kode = strtoupper($pengajuan->jenisSurat->kode);

        switch ($kode) {
            case 'SKTM':
                $detailSurat = $pengajuan->suratTidakMampu;
                break;
            case 'SKD':
                $detailSurat = $pengajuan->suratKeteranganDomisili;
                break;
            case 'SKU':
                $detailSurat = $pengajuan->suratKeteranganUsaha;
                break;
            case 'SKMT':
                $detailSurat = $pengajuan->suratKematian;
                break;
            case 'SKP':
                $detailSurat = $pengajuan->suratPenghasilan;
        }



        return view('admin.arsip.show', compact('pengajuan', 'detailSurat'));
    }

    public function downloadCetak($id)
    {
        try {
            $pengajuan = PengajuanSurat::with('jenisSurat')->findOrFail($id);

            if (!$pengajuan->file_surat_cetak) {
                return back()->with('error', 'File surat cetak tidak ditemukan');
            }

            $jenisSurat = strtolower($pengajuan->jenisSurat->kode ?? 'surat');
            $filePath = storage_path('app/surat/' . $jenisSurat . '/' . $pengajuan->file_surat_cetak);

            if (!file_exists($filePath)) {
                return back()->with('error', 'File tidak ditemukan di server');
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunduh file: ' . $e->getMessage());
        }
    }

    public function downloadTtd($id)
    {
        try {
            $pengajuan = PengajuanSurat::findOrFail($id);

            if (!$pengajuan->file_surat_ttd) {
                return back()->with('error', 'File surat bertanda tangan belum tersedia.');
            }

            $filePath = storage_path('app/public/surat_ttd/' . $pengajuan->file_surat_ttd);

            if (!file_exists($filePath)) {
                return back()->with('error', 'File tidak ditemukan di server.');
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunduh file: ' . $e->getMessage());
        }
    }
}
