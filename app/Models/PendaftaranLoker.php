<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranLoker extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_loker';
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = [
        'id_loker',
        'nama',
        'email',
        'telepon',
        'whatsapp',
        'alamat',
        'pendidikan_terakhir',
        'pengalaman',
        'cv_file',
        'catatan',
        'status_pendaftaran',
        'tanggal_pendaftaran'
    ];

    protected $casts = [
        'tanggal_pendaftaran' => 'datetime',
    ];

    // Relasi ke Loker
    public function loker()
    {
        return $this->belongsTo(Loker::class, 'id_loker', 'id_loker');
    }

    public function scopeBaru($query)
    {
        return $query->where('status_pendaftaran', 'Baru');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('id_pendaftaran', 'DESC');
    }
}
