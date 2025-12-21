<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengajuan', 50)->unique();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->onDelete('restrict');
            $table->string('nomor_surat', 100)->unique()->nullable();
            $table->string('nama_pemohon', 100);
            $table->string('email_pemohon', 100);
            $table->string('no_hp_pemohon', 20);
            $table->enum('status', ['pending', 'diproses', 'siap_ttd_kades', 'siap_diambil', 'selesai', 'ditolak'])->default('pending');
            $table->foreignId('admin_id')->nullable()->constrained('admin')->onDelete('set null');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_diproses')->nullable();
            $table->string('file_surat_cetak')->nullable();
            $table->timestamp('tanggal_cetak')->nullable();
            $table->timestamp('tanggal_notifikasi_warga')->nullable();
            $table->timestamp('tanggal_diambil')->nullable();
            $table->foreignId('admin_serah_terima_id')->nullable()->constrained('admin')->onDelete('set null');
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
