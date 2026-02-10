<?php

use App\Models\ActivityLog;

if (!function_exists('logActivity')) {
    function logActivity(string $aksi, string $deskripsi)
    {
        if (!auth()->check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'role' => auth()->user()->role,
            'aksi' => $aksi,
            'deskripsi' => $deskripsi,
        ]);
    }
}
