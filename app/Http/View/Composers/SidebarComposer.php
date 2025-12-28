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
        })->where('status', 'pending')->count();

        $pendingSkck = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKCK');
        })->where('status', 'pending')->count();

        $pendingSkd = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKD');
        })->where('status', 'pending')->count();

        $pendingSku = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKU');
        })->where('status', 'pending')->count();

        $view->with([
            'pendingSktm' => $pendingSktm,
            'pendingSkck' => $pendingSkck,
            'pendingSkd' => $pendingSkd,
            'pendingSku' => $pendingSku,
        ]);
    }
}
