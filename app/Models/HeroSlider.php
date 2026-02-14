<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;

    protected $table = 'hero_sliders';
    protected $primaryKey = 'id_hero';
    protected $fillable = [
        'title_id',
        'title_en',
        'title_jp',
        'subtitle_id',
        'subtitle_en',
        'subtitle_jp',
        'country_id',
        'country_en',
        'country_jp',
        'description_id',
        'description_en',
        'description_jp',
        'background_image',
        'person_image',
        'button_text_id',
        'button_text_en',
        'button_text_jp',
        'button_link',
        'video_link',
        'person_images',
        'urutan',
        'status'
    ];

    protected $casts = [
        'person_images' => 'array'
    ];

    public function scopePublish($query)
    {
        return $query->where('status', 'Publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'ASC')->orderBy('id_hero', 'DESC');
    }
}
