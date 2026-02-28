<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    protected $table = 'komisi';
    protected $primaryKey = 'id_komisi';
    protected $fillable = [
        'id_mitra',
        'id_referal',
        'jumlah_komisi',
        'status',
        'tanggal',
        'keterangan'
    ];

    protected $casts = [
        'jumlah_komisi' => 'decimal:2',
        'tanggal' => 'datetime'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }

    public function referal()
    {
        return $this->belongsTo(Referal::class, 'id_referal', 'id_referal');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'Paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }
}
