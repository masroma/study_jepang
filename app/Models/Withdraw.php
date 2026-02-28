<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $table = 'withdraw';
    protected $primaryKey = 'id_withdraw';
    protected $fillable = [
        'id_mitra',
        'jumlah',
        'bank',
        'rekening',
        'nama_rekening',
        'status',
        'tanggal',
        'catatan'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal' => 'datetime'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }
}
