<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramMasaDepan extends Model
{
    use HasFactory;

    protected $table = 'program_masa_depan';
    protected $primaryKey = 'id_program';
    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'lokasi',
        'durasi',
        'visa',
        'gaji',
        'sertifikat',
        'urutan',
        'status'
    ];

    public function scopePublish($query)
    {
        return $query->where('status', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_program', 'DESC');
    }
}
