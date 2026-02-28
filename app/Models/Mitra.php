<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = 'mitra';
    protected $primaryKey = 'id_mitra';
    protected $fillable = [
        'id_user',
        'kode_referal',
        'saldo',
        'status',
        'tanggal_daftar'
    ];

    protected $casts = [
        'saldo' => 'decimal:2',
        'tanggal_daftar' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User_model::class, 'id_user', 'id_user');
    }

    public function referals()
    {
        return $this->hasMany(Referal::class, 'id_mitra', 'id_mitra');
    }

    public function komisis()
    {
        return $this->hasMany(Komisi::class, 'id_mitra', 'id_mitra');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'id_mitra', 'id_mitra');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
}
