<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'nama',
        'slug',
        'kategori',
        'deskripsi',
        'spesifikasi',
        'gambar',
        'moq',
        'harga',
        'asal',
        'sertifikasi',
        'kemasan',
        'urutan',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = Str::slug($produk->nama);
            }
        });

        static::updating(function ($produk) {
            if ($produk->isDirty('nama') && empty($produk->slug)) {
                $produk->slug = Str::slug($produk->nama);
            }
        });
    }

    public function scopePublish($query)
    {
        return $query->where('status', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_produk', 'DESC');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
