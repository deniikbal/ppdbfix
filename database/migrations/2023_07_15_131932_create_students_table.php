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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('uuid')->nullable();
            $table->string('nodaftar')->nullable();
            $table->string('name')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('nik')->nullable();
            $table->string('agama')->nullable();
            $table->string('nohp_siswa')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('tinggal')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('hoby')->nullable();
            $table->string('cita')->nullable();
            $table->string('nisn')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('npsn')->nullable();
            $table->string('provinsi_sekolah')->nullable();
            $table->string('kota_sekolah')->nullable();
            $table->string('kec_sekolah')->nullable();
            $table->string('desa_sekolah')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('tahun_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('tahun_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('alamat_pd')->nullable();
            $table->string('jarak')->nullable();
            $table->string('waktu')->nullable();
            $table->string('provinsi_pd')->nullable();
            $table->string('kota_pd')->nullable();
            $table->string('kec_pd')->nullable();
            $table->string('nohp_ortu')->nullable();
            $table->string('foto')->nullable();
            $table->integer('verifikasi')->default(0);
            $table->integer('notif_wa')->default(0);
            $table->string('doc_ijazah')->nullable();
            $table->string('doc_kk')->nullable();
            $table->string('doc_akte')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
