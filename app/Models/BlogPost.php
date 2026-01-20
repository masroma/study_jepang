<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';
    protected $primaryKey = 'id_post';
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'deskripsi_singkat',
        'kategori',
        'gambar',
        'penulis',
        'tanggal_publish',
        'status',
        'views'
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];

    // Scope untuk artikel yang publish
    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    // Scope untuk urutan terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal_publish', 'DESC');
    }

    // Scope berdasarkan kategori
    public function scopeByCategory($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Get URL artikel
    public function getUrlAttribute()
    {
        return route('blog.detail', $this->slug);
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}
