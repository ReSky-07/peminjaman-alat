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
        MODIFY status ENUM(
            'pending',
            'disetujui',
            'dikembalikan',
            'ditolak',
            'menunggu_konfirmasi',
            'menunggu_pembayaran',
            'menunggu_verifikasi'
        )
    ");
    }

    public function down()
    {
        DB::statement("
        ALTER TABLE peminjamans 
        MODIFY status ENUM(
            'pending',
            'disetujui',
            'dikembalikan',
            'ditolak',
            'menunggu_konfirmasi'
        )
    ");
    }
};
