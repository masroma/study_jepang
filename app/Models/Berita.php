<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $fillable = [
        'id_kategori',
        'id_user',
        'slug_berita',
        'judul_berita',
        'isi',
        'jenis_berita',
        'status_berita',
        'gambar',
        'icon',
        'keywords',
        'tanggal_publish',
        'urutan',
        'tanggal_post'
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'tanggal_post' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug_berita)) {
                $berita->slug_berita = Str::slug($berita->judul_berita);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul_berita') && empty($berita->slug_berita)) {
                $berita->slug_berita = Str::slug($berita->judul_berita);
            }
        });
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke User (menggunakan DB karena mungkin tidak ada model User dengan id_user)
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user', 'id_user');
    // }

    public function scopePublish($query)
    {
        return $query->where('status_berita', 'Publish');
    }

    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis_berita', $jenis);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_berita', 'DESC');
    }
}
