<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori',
        'slug_kategori',
        'urutan'
    ];

    // Relasi ke Berita
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori', 'id_kategori');
    }
}
