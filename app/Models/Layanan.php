<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'judul',
        'slug',
        'icon',
        'deskripsi',
        'fitur',
        'lokasi',
        'gambar',
        'urutan',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($layanan) {
            if (empty($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->judul);
            }
        });

        static::updating(function ($layanan) {
            if ($layanan->isDirty('judul') && empty($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->judul);
            }
        });
    }

    public function scopePublish($query)
    {
        return $query->where('status', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_layanan', 'DESC');
    }
}
