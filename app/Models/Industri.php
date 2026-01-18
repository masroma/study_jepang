<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;

    protected $table = 'industri';
    protected $primaryKey = 'id_industri';
    protected $fillable = [
        'nama',
        'sub_nama',
        'gambar',
        'deskripsi',
        'urutan',
        'status'
    ];

    public function scopePublish($query)
    {
        return $query->where('status', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_industri', 'DESC');
    }
}
