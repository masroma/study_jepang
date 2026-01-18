<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KisahSukses extends Model
{
    use HasFactory;

    protected $table = 'kisah_sukses';
    protected $primaryKey = 'id_kisah';
    protected $fillable = [
        'nama',
        'pekerjaan',
        'lokasi',
        'testimoni',
        'foto',
        'program',
        'tahun',
        'rating',
        'video_url',
        'video_file',
        'urutan',
        'status'
    ];

    public function scopePublish($query)
    {
        return $query->where('status', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_kisah', 'DESC');
    }

    // Helper untuk generate star rating HTML
    public function getStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '★';
            } else {
                $stars .= '☆';
            }
        }
        return $stars;
    }
}
