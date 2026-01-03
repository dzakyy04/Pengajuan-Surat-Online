<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = PengajuanSurat::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $sedangDiproses = PengajuanSurat::where('status', 'submitted')
            ->count();

        $diverifikasi = PengajuanSurat::where('status', 'verified')
            ->count();

        $disetujui = PengajuanSurat::where('status', 'approved')
            ->count();

        $diberitakan = PengajuanSurat::where('status', 'notified')
            ->count();


        $ditolak = PengajuanSurat::where('status', 'rejected')
            ->count();

        $pengajuanTerbaru = PengajuanSurat::with('jenisSurat')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $statistikPerJenis = PengajuanSurat::select('jenis_surat_id', DB::raw('count(*) as total'))
            ->with('jenisSurat')
            ->groupBy('jenis_surat_id')
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->jenisSurat->nama ?? 'Unknown',
                    'total' => $item->total,
                    'kode' => $item->jenisSurat->kode ?? 'UNK'
                ];
            });

        $progressPerJenis = JenisSurat::withCount([
            'pengajuanSurat as total_pengajuan',
            'pengajuanSurat as total_approved' => function ($query) {
                $query->whereIn('status', ['approved', 'notified']);
            }
        ])
            ->where('aktif', true)
            ->get()
            ->map(function ($item) {
                $persentase = $item->total_pengajuan > 0
                    ? round(($item->total_approved / $item->total_pengajuan) * 100)
                    : 0;
                return [
                    'nama' => $item->nama,
                    'kode' => $item->kode,
                    'total' => $item->total_pengajuan,
                    'approved' => $item->total_approved,
                    'persentase' => $persentase
                ];
            });

        $statistikStatus = [
            'submitted' => PengajuanSurat::where('status', 'submitted')->count(),
            'verified' => PengajuanSurat::where('status', 'verified')->count(),
            'approved' => PengajuanSurat::where('status', 'approved')->count(),
            'notified' => PengajuanSurat::where('status', 'notified')->count(),
            'rejected' => PengajuanSurat::where('status', 'rejected')->count(),
        ];

        $statistik7Hari = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $statistik7Hari[] = [
                'tanggal' => $tanggal->format('d M'),
                'jumlah' => PengajuanSurat::whereDate('created_at', $tanggal->toDateString())->count()
            ];
        }

        return view('admin.dashboard', compact(
            'totalPengajuan',
            'sedangDiproses',
            'diberitakan',
            'diverifikasi',
            'disetujui',
            'ditolak',
            'pengajuanTerbaru',
            'statistikPerJenis',
            'progressPerJenis',
            'statistikStatus',
            'statistik7Hari'
        ));
    }
}