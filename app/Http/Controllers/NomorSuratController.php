<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NomorSuratController extends Controller
{
    public function index()
    {
        $jenisSurat = JenisSurat::orderBy('kode')->get();

        return view('admin.manajemen-nomor.index', compact('jenisSurat'));
    }

    public function updateCounter(Request $request, $id)
    {
        $request->validate([
            'counter_terakhir' => 'required|integer|min:0',
            'tahun_counter' => 'required|digits:4',
            'format_nomor' => 'required|string|max:100',
        ], [
            'counter_terakhir.required' => 'Nomor terakhir harus diisi',
            'counter_terakhir.integer' => 'Nomor terakhir harus berupa angka',
            'counter_terakhir.min' => 'Nomor terakhir minimal 0',
            'tahun_counter.required' => 'Tahun harus diisi',
            'tahun_counter.digits' => 'Tahun harus 4 digit',
            'format_nomor.required' => 'Format nomor harus diisi',
            'format_nomor.max' => 'Format nomor maksimal 100 karakter',
        ]);

        try {
            DB::beginTransaction();

            $jenisSurat = JenisSurat::findOrFail($id);

            // Validasi format nomor harus mengandung [NO] dan [TAHUN]
            if (!str_contains($request->format_nomor, '[NO]') || !str_contains($request->format_nomor, '[TAHUN]')) {
                return redirect()->back()
                    ->with('error', 'Format nomor harus mengandung placeholder [NO] dan [TAHUN]')
                    ->withInput();
            }

            $jenisSurat->update([
                'counter_terakhir' => $request->counter_terakhir,
                'tahun_counter' => $request->tahun_counter,
                'format_nomor' => $request->format_nomor,
            ]);

            DB::commit();

            return redirect()->route('admin.manajemen-nomor.index')
                ->with('success', 'Nomor surat berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui nomor surat: ' . $e->getMessage());
        }
    }

    public function updateFormat(Request $request, $id)
    {
        $request->validate([
            'format_nomor' => 'required|string|max:100',
        ], [
            'format_nomor.required' => 'Format nomor harus diisi',
            'format_nomor.max' => 'Format nomor maksimal 100 karakter',
        ]);

        try {
            DB::beginTransaction();

            $jenisSurat = JenisSurat::findOrFail($id);

            // Validasi format nomor harus mengandung [NO] dan [TAHUN]
            if (!str_contains($request->format_nomor, '[NO]') || !str_contains($request->format_nomor, '[TAHUN]')) {
                return redirect()->back()
                    ->with('error', 'Format nomor harus mengandung placeholder [NO] dan [TAHUN]')
                    ->withInput();
            }

            $jenisSurat->update([
                'format_nomor' => $request->format_nomor,
            ]);

            DB::commit();

            return redirect()->route('admin.manajemen-nomor.index')
                ->with('success', 'Format nomor berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui format nomor: ' . $e->getMessage());
        }
    }

    public function preview(Request $request)
    {
        $formatNomor = $request->input('format_nomor');
        $counter = $request->input('counter', 0);
        $tahun = $request->input('tahun', date('Y'));

        $nomorBerikutnya = $counter + 1;
        $previewNomor = str_replace(
            ['[NO]', '[TAHUN]'],
            [str_pad($nomorBerikutnya, 4, '0', STR_PAD_LEFT), $tahun],
            $formatNomor
        );

        return response()->json([
            'success' => true,
            'nomor_berikutnya' => $nomorBerikutnya,
            'format_nomor' => $previewNomor,
        ]);
    }
}
