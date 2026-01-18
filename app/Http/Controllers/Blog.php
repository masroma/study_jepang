<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Blog extends Controller
{
    // Index
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();

        $data = array(  'title'         => 'Blog - '.$site_config->namaweb,
                        'deskripsi'     => 'Blog - '.$site_config->namaweb,
                        'keywords'      => 'Blog - '.$site_config->namaweb,
                        'site_config'   => $site_config,
                        'content'       => 'blog'
                    );
        return view('blog', $data);
    }
}