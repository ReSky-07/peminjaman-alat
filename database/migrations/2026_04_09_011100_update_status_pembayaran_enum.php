<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE peminjamans 
        MODIFY status_pembayaran 
        ENUM(
            'belum_bayar',
            'menunggu_verifikasi',
            'ditolak',
            'sudah_bayar'
        ) DEFAULT 'belum_bayar'
    ");
    }

    public function down()
    {
        DB::statement("
        ALTER TABLE peminjamans 
        MODIFY status_pembayaran 
        ENUM(
            'belum_bayar',
            'menunggu_verifikasi',
            'sudah_bayar'
        )
    ");
    }
};
