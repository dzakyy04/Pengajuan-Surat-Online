<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\PengajuanSurat;

class SidebarComposer
{
    public function compose(View $view)
    {
        $pendingSktm = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKTM');
        })->where('status', 'submitted')->count();

        $pendingSkp = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKP');
        })->where('status', 'submitted')->count();

        $pendingSkd = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKD');
        })->where('status', 'submitted')->count();

        $pendingSku = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKU');
        })->where('status', 'submitted')->count();

        $pendingSkmt = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKMT');
        })->where('status', 'submitted')->count();

        $view->with([
            'pendingSktm' => $pendingSktm,
            'pendingSkp' => $pendingSkp,
            'pendingSkd' => $pendingSkd,
            'pendingSku' => $pendingSku,
            'pendingSkmt' => $pendingSkmt,
        ]);
    }
}
