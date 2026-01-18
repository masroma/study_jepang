<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kontak_model extends Model
{

	protected $table 		= "kontak";
	protected $primaryKey 	= 'id_kontak';

     // listing
    public function semua()
    {
        $query = DB::table('kontak')
            ->orderBy('id_kontak','DESC')
            ->paginate(25);
        return $query;
    }

    // detail
    public function detail($id_kontak)
    {
        $query = DB::table('kontak')
            ->where('id_kontak',$id_kontak)
            ->first();
        return $query;
    }

    // cari
    public function cari($keywords)
    {
        $query = DB::table('kontak')
            ->where('nama', 'LIKE', "%{$keywords}%")
            ->orWhere('email', 'LIKE', "%{$keywords}%")
            ->orWhere('subjek', 'LIKE', "%{$keywords}%")
            ->orWhere('pesan', 'LIKE', "%{$keywords}%")
            ->orderBy('id_kontak','DESC')
            ->paginate(25);
        return $query;
    }

    // status
    public function status($status_kontak)
    {
        $query = DB::table('kontak')
            ->where('status_kontak',$status_kontak)
            ->orderBy('id_kontak','DESC')
            ->paginate(25);
        return $query;
    }
}