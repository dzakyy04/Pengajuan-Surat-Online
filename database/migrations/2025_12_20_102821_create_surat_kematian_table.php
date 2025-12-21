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
        Schema::create('surat_kematian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_surat_id')->unique()->constrained('pengajuan_surat')->onDelete('cascade');
            $table->string('nama_almarhum', 100);
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->integer('umur');
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('dusun', 50)->nullable();
            $table->date('tanggal_meninggal');
            $table->time('jam_meninggal');
            $table->string('hari_meninggal', 20);
            $table->string('tempat_meninggal', 100);
            $table->string('sebab_meninggal', 100);
            $table->string('nama_pelapor', 100);
            $table->string('nik_pelapor', 16);
            $table->enum('jenis_kelamin_pelapor', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir_pelapor', 100);
            $table->date('tanggal_lahir_pelapor');
            $table->string('agama_pelapor', 20);
            $table->string('pekerjaan_pelapor', 100);
            $table->text('alamat_pelapor');
            $table->string('rt_pelapor', 5);
            $table->string('rw_pelapor', 5);
            $table->string('hubungan_pelapor', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kematian');
    }
};
