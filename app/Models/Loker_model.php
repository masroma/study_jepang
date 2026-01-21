<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Loker_model extends Model
{
    protected $table = "loker";
    protected $primaryKey = 'id_loker';

    // listing
    public function semua()
    {
        $query = DB::table('loker')
            ->orderBy('urutan','ASC')
            ->orderBy('id_loker','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_loker)
    {
        $query = DB::table('loker')
            ->where('id_loker',$id_loker)
            ->first();
        return $query;
    }

    // detail by slug
    public function detail_slug($slug_loker)
    {
        $query = DB::table('loker')
            ->where('slug_loker',$slug_loker)
            ->where('status_loker','Publish')
            ->first();
        return $query;
    }

    // listing publik
    public function publik()
    {
        $query = DB::table('loker')
            ->where('status_loker','Publish')
            ->where(function($query) {
                $query->whereNull('tanggal_selesai')
                      ->orWhere('tanggal_selesai', '>=', date('Y-m-d'));
            })
            ->orderBy('urutan','ASC')
            ->orderBy('id_loker','DESC')
            ->get();
        return $query;
    }

    // cari
    public function cari($keywords)
    {
        $query = DB::table('loker')
            ->where('judul_loker', 'LIKE', "%{$keywords}%")
            ->orWhere('isi_loker', 'LIKE', "%{$keywords}%")
            ->orWhere('posisi', 'LIKE', "%{$keywords}%")
            ->orderBy('id_loker','DESC')
            ->get();
        return $query;
    }

    // status
    public function status($status_loker)
    {
        $query = DB::table('loker')
            ->where('status_loker',$status_loker)
            ->orderBy('id_loker','DESC')
            ->get();
        return $query;
    }
}
