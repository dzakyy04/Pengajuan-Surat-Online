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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            // $table->string('no_hp', 15)->nullable();
            // $table->string('nik', 16)->nullable();
            // $table->string('tempat_lahir', 100)->nullable();
            // $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            // $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            // $table->string('agama', 20);
            // $table->string('pekerjaan', 100);
            // $table->text('alamat');
            // $table->string('rt', 5);
            // $table->string('rw', 5);
            // $table->string('dusun', 50)->nullable();
            // $table->string('dokumen_ktp')->nullable();
            // $table->string('dokumen_kk')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
