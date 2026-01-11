<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\SuratUsaha;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SuratDomisili;
use App\Models\SuratKematian;
use App\Models\PengajuanSurat;
use App\Models\SuratTidakMampu;
use App\Mail\PengajuanSuratMail;
use App\Models\SuratPenghasilan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MasyarakatController extends Controller
{
    public function index()
    {
        return view('frontend.beranda');
    }

    public function form()
    {
        $jenisSurat = JenisSurat::all();
        return view('frontend.form-pengajuan', compact('jenisSurat'));
    }

    public function submitForm(Request $request)
    {
        // Ambil jenis surat dulu (buat tahu kode)
        $jenis = JenisSurat::findOrFail($request->jenis_surat_id);
        $kode  = $jenis->kode;

        // Rules dasar (selalu ada untuk semua)
        $rules = [
            'jenis_surat_id'   => ['required', 'exists:jenis_surat,id'],
            'email_pemohon'    => ['required', 'email', 'max:100'],
            'no_hp_pemohon'    => ['required', 'max:20'],

            'jenis_kelamin'    => ['required', 'in:Laki-Laki,Perempuan'],
            'alamat'           => ['required'],
            'rt'               => ['required', 'max:5'],
            'rw'               => ['required', 'max:5'],
            'dusun'            => ['nullable', 'max:50'],

            'no_surat_rt'      => ['required', 'max:50'],
            'tanggal_surat_rt' => ['required', 'date'],

            'dokumen_ktp'      => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf'],
            'dokumen_kk'       => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf'],
            'dokumen_surat_rt' => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf'],
        ];

        // Rules kondisional sesuai kode surat
        if ($kode === 'SKMT') {
            // Surat Kematian (field pemohon beda: nama -> nama_almarhum, umur wajib)
            $rules = array_merge($rules, [
                'nama' => ['required', 'max:100'],
                'umur' => ['required', 'integer', 'min:0', 'max:150'],

                'hari_meninggal'   => ['required', 'max:20'],
                'tanggal_meninggal' => ['required', 'date'],
                'jam_meninggal'    => ['required', 'date_format:H:i'],
                'tempat_meninggal' => ['required', 'max:100'],
                'sebab_meninggal'  => ['required', 'max:100'],

                'nama_pelapor'            => ['required', 'max:100'],
                'nik_pelapor'             => ['required', 'digits:16'],
                'jenis_kelamin_pelapor'   => ['required', 'in:Laki-Laki,Perempuan'],
                'tempat_lahir_pelapor'    => ['required', 'max:100'],
                'tanggal_lahir_pelapor'   => ['required', 'date'],
                'agama_pelapor'           => ['required', 'max:20'],
                'pekerjaan_pelapor'       => ['required', 'max:100'],
                'alamat_pelapor'          => ['required'],
                'rt_pelapor'              => ['required', 'max:5'],
                'rw_pelapor'              => ['required', 'max:5'],
                'hubungan_pelapor'        => ['required', 'max:50'],
            ]);
        } else {
            // Surat selain kematian (punya NIK + TTL + status perkawinan + agama + pekerjaan)
            $rules = array_merge($rules, [
                'nama'            => ['required', 'max:100'],
                'nik'             => ['required', 'digits:16'],
                'tempat_lahir'    => ['required', 'max:100'],
                'tanggal_lahir'   => ['required', 'date'],
                'status_perkawinan' => ['required', 'in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati'],
                'agama'           => ['required', 'max:20'],
                'pekerjaan'       => ['required', 'max:100'],
            ]);

            // Detail per jenis surat:
            if ($kode === 'SKTM') {
                $rules['keperluan'] = ['required'];
                // anggota keluarga opsional, tapi kalau diisi harus valid
                $rules['anggota_nama'] = ['array'];
                $rules['anggota_nama.*'] = ['nullable', 'max:100'];
                $rules['anggota_nik'] = ['array'];
                $rules['anggota_nik.*'] = ['nullable', 'digits:16'];
            }

            if ($kode === 'SKD') {
                $rules['keperluan'] = ['nullable'];
            }

            if ($kode === 'SKU') {
                $rules = array_merge($rules, [
                    'nama_usaha'       => ['required', 'max:100'],
                    'jenis_usaha'      => ['required', 'max:100'],
                    'alamat_usaha'     => ['required'],
                    'keterangan_usaha' => ['nullable'],
                ]);
            }

            if ($kode === 'SKP') {
                $rules = array_merge($rules, [
                    'penghasilan_perbulan' => ['required', 'numeric', 'min:0'],
                    'nama_anak'            => ['nullable', 'max:100'],
                    'keterangan_tambahan'  => ['nullable'],
                ]);
            }
        }

        try {
            $validated = $request->validate($rules);

            $result = DB::transaction(function () use ($request, $jenis, $kode) {

                // Nomor pengajuan unik
                $nomorPengajuan = now()->format('YmdHis');

                // Upload dokumen
                $baseDir = "pengajuan/{$nomorPengajuan}";
                $pathKtp = $request->file('dokumen_ktp')->store($baseDir, 'public');
                $pathKk  = $request->file('dokumen_kk')->store($baseDir, 'public');
                $pathRt  = $request->file('dokumen_surat_rt')->store($baseDir, 'public');

                // Simpan ke pengajuan_surat
                $pengajuan = PengajuanSurat::create([
                    'nomor_pengajuan' => $nomorPengajuan,
                    'jenis_surat_id'  => $jenis->id,
                    'nama_pemohon'    => $request->nama,
                    'email_pemohon'   => $request->email_pemohon,
                    'no_hp_pemohon'   => $request->no_hp_pemohon,
                    'dokumen_ktp'     => $pathKtp,
                    'dokumen_kk'      => $pathKk,
                    'dokumen_surat_rt' => $pathRt,
                ]);

                // Simpan detail sesuai kode
                switch ($kode) {
                    case 'SKTM':
                        $anggota = null;
                        $namaArr = $request->input('anggota_nama', []);
                        $nikArr  = $request->input('anggota_nik', []);

                        $temp = [];
                        for ($i = 0; $i < count($namaArr); $i++) {
                            $n = trim((string)($namaArr[$i] ?? ''));
                            $k = trim((string)($nikArr[$i] ?? ''));
                            if ($n !== '' && $k !== '') {
                                $temp[] = ['nama' => $n, 'nik' => $k];
                            }
                        }
                        if (count($temp) > 0) $anggota = $temp;

                        SuratTidakMampu::create([
                            'pengajuan_surat_id' => $pengajuan->id,
                            'nama'               => $request->nama,
                            'nik'                => $request->nik,
                            'tempat_lahir'       => $request->tempat_lahir,
                            'tanggal_lahir'      => $request->tanggal_lahir,
                            'jenis_kelamin'      => $request->jenis_kelamin,
                            'status_perkawinan'  => $request->status_perkawinan,
                            'agama'              => $request->agama,
                            'pekerjaan'          => $request->pekerjaan,
                            'alamat'             => $request->alamat,
                            'rt'                 => $request->rt,
                            'rw'                 => $request->rw,
                            'dusun'              => $request->dusun,
                            'no_surat_rt'        => $request->no_surat_rt,
                            'tanggal_surat_rt'   => $request->tanggal_surat_rt,
                            'keperluan'          => $request->keperluan,
                            'anggota_keluarga'   => $anggota,
                        ]);
                        break;

                    case 'SKD':
                        SuratDomisili::create([
                            'pengajuan_surat_id' => $pengajuan->id,
                            'nama'               => $request->nama,
                            'nik'                => $request->nik,
                            'tempat_lahir'       => $request->tempat_lahir,
                            'tanggal_lahir'      => $request->tanggal_lahir,
                            'jenis_kelamin'      => $request->jenis_kelamin,
                            'status_perkawinan'  => $request->status_perkawinan,
                            'agama'              => $request->agama,
                            'pekerjaan'          => $request->pekerjaan,
                            'alamat'             => $request->alamat,
                            'rt'                 => $request->rt,
                            'rw'                 => $request->rw,
                            'dusun'              => $request->dusun,
                            'no_surat_rt'        => $request->no_surat_rt,
                            'tanggal_surat_rt'   => $request->tanggal_surat_rt,
                            'keperluan'          => $request->keperluan,
                        ]);
                        break;

                    case 'SKU':
                        SuratUsaha::create([
                            'pengajuan_surat_id' => $pengajuan->id,
                            'nama'               => $request->nama,
                            'nik'                => $request->nik,
                            'tempat_lahir'       => $request->tempat_lahir,
                            'tanggal_lahir'      => $request->tanggal_lahir,
                            'jenis_kelamin'      => $request->jenis_kelamin,
                            'status_perkawinan'  => $request->status_perkawinan,
                            'agama'              => $request->agama,
                            'pekerjaan'          => $request->pekerjaan,
                            'alamat'             => $request->alamat,
                            'rt'                 => $request->rt,
                            'rw'                 => $request->rw,
                            'dusun'              => $request->dusun,
                            'no_surat_rt'        => $request->no_surat_rt,
                            'tanggal_surat_rt'   => $request->tanggal_surat_rt,
                            'nama_usaha'         => $request->nama_usaha,
                            'jenis_usaha'        => $request->jenis_usaha,
                            'alamat_usaha'       => $request->alamat_usaha,
                            'keterangan_usaha'   => $request->keterangan_usaha,
                        ]);
                        break;

                    case 'SKP':
                        SuratPenghasilan::create([
                            'pengajuan_surat_id'    => $pengajuan->id,
                            'nama'                  => $request->nama,
                            'nik'                   => $request->nik,
                            'tempat_lahir'          => $request->tempat_lahir,
                            'tanggal_lahir'         => $request->tanggal_lahir,
                            'jenis_kelamin'         => $request->jenis_kelamin,
                            'status_perkawinan'     => $request->status_perkawinan,
                            'agama'                 => $request->agama,
                            'pekerjaan'             => $request->pekerjaan,
                            'alamat'                => $request->alamat,
                            'rt'                    => $request->rt,
                            'rw'                    => $request->rw,
                            'dusun'                 => $request->dusun,
                            'no_surat_rt'           => $request->no_surat_rt,
                            'tanggal_surat_rt'      => $request->tanggal_surat_rt,
                            'penghasilan_perbulan'  => $request->penghasilan_perbulan,
                            'nama_anak'             => $request->nama_anak,
                            'keterangan_tambahan'   => $request->keterangan_tambahan,
                        ]);
                        break;

                    case 'SKMT':
                        SuratKematian::create([
                            'pengajuan_surat_id' => $pengajuan->id,
                            'nama_almarhum'      => $request->nama,
                            'jenis_kelamin'      => $request->jenis_kelamin,
                            'umur'               => $request->umur,
                            'alamat'             => $request->alamat,
                            'rt'                 => $request->rt,
                            'rw'                 => $request->rw,
                            'dusun'              => $request->dusun,
                            'tanggal_meninggal'  => $request->tanggal_meninggal,
                            'jam_meninggal'      => $request->jam_meninggal,
                            'hari_meninggal'     => $request->hari_meninggal,
                            'tempat_meninggal'   => $request->tempat_meninggal,
                            'sebab_meninggal'    => $request->sebab_meninggal,
                            'nama_pelapor'            => $request->nama_pelapor,
                            'nik_pelapor'             => $request->nik_pelapor,
                            'jenis_kelamin_pelapor'   => $request->jenis_kelamin_pelapor,
                            'tempat_lahir_pelapor'    => $request->tempat_lahir_pelapor,
                            'tanggal_lahir_pelapor'   => $request->tanggal_lahir_pelapor,
                            'agama_pelapor'           => $request->agama_pelapor,
                            'pekerjaan_pelapor'       => $request->pekerjaan_pelapor,
                            'alamat_pelapor'          => $request->alamat_pelapor,
                            'rt_pelapor'              => $request->rt_pelapor,
                            'rw_pelapor'              => $request->rw_pelapor,
                            'hubungan_pelapor'        => $request->hubungan_pelapor,
                        ]);
                        break;

                    default:
                        throw new \Exception("Kode jenis surat tidak dikenali: {$kode}");
                }

                return [
                    'nomor_pengajuan' => $nomorPengajuan,
                    'email' => $request->email_pemohon,
                    'no_hp' => $request->no_hp_pemohon,
                    'nama' => $request->nama,
                    'jenis_surat' => $jenis->nama,
                ];
            });

            // Kirim email konfirmasi
            try {
                Mail::to($result['email'])->send(
                    new PengajuanSuratMail(
                        $result['nomor_pengajuan'],
                        $result['nama'],
                        $result['jenis_surat']
                    )
                );
            } catch (\Exception $e) {
                // Log error tapi jangan gagalkan proses
                \Log::error('Error mengirim email: ' . $e->getMessage());
            }

            // Return JSON untuk AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengajuan berhasil dikirim. Email konfirmasi telah dikirim ke ' . $result['email'],
                    'no_pengajuan' => $result['nomor_pengajuan'],
                    'email' => $result['email'],
                    'no_hp' => $result['no_hp'],
                    'nama' => $result['nama'],
                    'redirect' => route('pengajuan')
                ]);
            }

            // Redirect biasa untuk non-AJAX
            return redirect()
                ->route('pengajuan')
                ->with('success', "Pengajuan berhasil dikirim. Nomor pengajuan: {$result['nomor_pengajuan']}. Email konfirmasi telah dikirim ke {$result['email']}");
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation error
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data yang Anda masukkan tidak valid',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            // Handle other errors
            \Log::error('Error saat submit pengajuan: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memproses pengajuan. Silakan coba lagi.'
                ], 500);
            }

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memproses pengajuan')
                ->withInput();
        }
    }
}
