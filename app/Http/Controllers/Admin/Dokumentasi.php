<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Konfigurasi_model;

class Dokumentasi extends Controller
{
    // Index
    public function index()
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
    	$mysite = new Konfigurasi_model();
		$site 	= $mysite->listing();
       
		$data = array(  'title'     => 'Dokumentasi CMS - '.$site->namaweb,
                        'content'   => 'admin/dokumentasi/index'
                    );
        return view('admin/layout/wrapper',$data);
    }
}
