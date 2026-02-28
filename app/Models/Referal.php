<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    protected $table = 'referal';
    protected $primaryKey = 'id_referal';
    protected $fillable = [
        'id_mitra',
        'nama',
        'email',
        'telepon',
        'program',
        'catatan',
        'status',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }

    public function komisi()
    {
        return $this->hasOne(Komisi::class, 'id_referal', 'id_referal');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeDiterima($query)
    {
        return $query->where('status', 'Diterima');
    }
}
