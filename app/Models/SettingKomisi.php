<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingKomisi extends Model
{
    protected $table = 'setting_komisi';
    protected $primaryKey = 'id_setting';
    protected $fillable = [
        'jenis',
        'persentase_komisi',
        'nominal_komisi',
        'tipe_komisi',
        'status',
        'tanggal_update'
    ];

    protected $casts = [
        'persentase_komisi' => 'decimal:2',
        'nominal_komisi' => 'decimal:2',
        'tanggal_update' => 'datetime'
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }
}
