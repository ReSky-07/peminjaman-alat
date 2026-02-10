<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'stok',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
