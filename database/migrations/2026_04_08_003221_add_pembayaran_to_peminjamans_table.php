<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'sudah_bayar'])
                ->default('belum_bayar');
        });
    }

    public function down()
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn(['bukti_pembayaran', 'status_pembayaran']);
        });
    }
};
