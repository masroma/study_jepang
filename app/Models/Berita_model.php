<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Berita_model extends Model
{
    protected $table      = "berita";
    protected $primaryKey = "id_berita";
    public $timestamps    = false;

    // =====================
    // BASE QUERY (BIAR RAPI & KONSISTEN)
    // =====================
    private function baseQuery()
    {
        return DB::table('berita')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->leftJoin('users', 'users.id_user', '=', 'berita.id_user')
            ->select(
                'berita.*',
                'kategori.slug_kategori',
                'kategori.nama_kategori',
                'users.nama as nama'
            );
    }

    // =====================
    // LISTING SEMUA
    // =====================
    public function semua()
    {
        return $this->baseQuery()
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    // =====================
    // UPDATE BERITA
    // =====================
    public function berita_update()
    {
        return $this->baseQuery()
            ->where('berita.jenis_berita', 'Berita')
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    // =====================
    // AUTHOR
    // =====================
    public function author($id_user)
    {
        return $this->baseQuery()
            ->where('berita.id_user', $id_user)
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    // =====================
    // CARI
    // =====================
    public function cari($keywords)
    {
        return $this->baseQuery()
            ->where(function ($query) use ($keywords) {
                $query->where('berita.judul_berita', 'LIKE', "%{$keywords}%")
                      ->orWhere('berita.isi', 'LIKE', "%{$keywords}%");
            })
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    // =====================
    // BERDASARKAN KATEGORI
    // =====================
    public function all_kategori($id_kategori)
    {
        return $this->baseQuery()
            ->where('berita.id_kategori', $id_kategori)
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    public function status_berita($status_berita)
    {
        return $this->baseQuery()
            ->where('berita.status_berita', $status_berita)
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    public function jenis_berita($jenis_berita)
    {
        return $this->baseQuery()
            ->where('berita.jenis_berita', $jenis_berita)
            ->orderBy('id_berita', 'DESC')
            ->paginate(25);
    }

    public function kategori_depan($id_kategori)
    {
        return $this->baseQuery()
            ->where([
                'berita.id_kategori'   => $id_kategori,
                'berita.jenis_berita'  => 'Berita',
                'berita.status_berita' => 'Publish'
            ])
            ->orderBy('id_berita', 'DESC')
            ->paginate(12);
    }

    // =====================
    // LISTING DEPAN
    // =====================
    public function listing()
    {
        return $this->baseQuery()
            ->where([
                'berita.status_berita' => 'Publish',
                'berita.jenis_berita'  => 'Berita'
            ])
            ->orderBy('id_berita', 'DESC')
            ->paginate(12);
    }

    // =====================
    // HOME
    // =====================
    public function home()
    {
        return $this->baseQuery()
            ->where([
                'berita.status_berita' => 'Publish',
                'berita.jenis_berita'  => 'Berita'
            ])
            ->orderBy('id_berita', 'DESC')
            ->limit(6)
            ->get();
    }

    // =====================
    // DETAIL (SLUG)
    // =====================
    public function read($slug_berita)
    {
        return $this->baseQuery()
            ->where('berita.slug_berita', $slug_berita)
            ->first();
    }

    // =====================
    // DETAIL (ID)
    // =====================
    public function detail($id_berita)
    {
        return $this->baseQuery()
            ->where('berita.id_berita', $id_berita)
            ->first();
    }
}
