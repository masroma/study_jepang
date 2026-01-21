<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PendaftaranLoker_model extends Model
{
    protected $table = "pendaftaran_loker";
    protected $primaryKey = 'id_pendaftaran';

    // listing
    public function semua()
    {
        $query = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi')
            ->orderBy('id_pendaftaran','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_pendaftaran)
    {
        $query = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi', 'loker.slug_loker')
            ->where('id_pendaftaran',$id_pendaftaran)
            ->first();
        return $query;
    }

    // by loker
    public function by_loker($id_loker)
    {
        $query = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi')
            ->where('pendaftaran_loker.id_loker',$id_loker)
            ->orderBy('id_pendaftaran','DESC')
            ->get();
        return $query;
    }

    // cari
    public function cari($keywords)
    {
        $query = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi')
            ->where('pendaftaran_loker.nama', 'LIKE', "%{$keywords}%")
            ->orWhere('pendaftaran_loker.email', 'LIKE', "%{$keywords}%")
            ->orWhere('loker.judul_loker', 'LIKE', "%{$keywords}%")
            ->orderBy('id_pendaftaran','DESC')
            ->get();
        return $query;
    }

    // status
    public function status($status_pendaftaran)
    {
        $query = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi')
            ->where('pendaftaran_loker.status_pendaftaran',$status_pendaftaran)
            ->orderBy('id_pendaftaran','DESC')
            ->get();
        return $query;
    }
}
