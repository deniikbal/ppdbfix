<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('id_bayar')->nullable();
            $table->string('jenis_bayar')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->string('nominal')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->integer('verifikasi')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
