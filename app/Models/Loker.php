<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'loker';
    protected $primaryKey = 'id_loker';
    protected $fillable = [
        'judul_loker',
        'slug_loker',
        'deskripsi_singkat',
        'isi_loker',
        'posisi',
        'lokasi_kerja',
        'tipe_kerja',
        'persyaratan',
        'tanggung_jawab',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_loker',
        'gambar',
        'urutan'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($loker) {
            if (empty($loker->slug_loker)) {
                $loker->slug_loker = Str::slug($loker->judul_loker);
            }
        });

        static::updating(function ($loker) {
            if ($loker->isDirty('judul_loker') && empty($loker->slug_loker)) {
                $loker->slug_loker = Str::slug($loker->judul_loker);
            }
        });
    }

    public function scopePublish($query)
    {
        return $query->where('status_loker', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_loker', 'DESC');
    }

    public function scopeAktif($query)
    {
        return $query->where('status_loker', 'Publish')
            ->where(function($q) {
                $q->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', date('Y-m-d'));
            });
    }
}
