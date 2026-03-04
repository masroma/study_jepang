<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\Berita_model;
Paginator::useBootstrap();

class Berita extends Controller
{
 
    // Beritapage
    public function index()
    {
        Paginator::useBootstrap();
    	$site 	= DB::table('konfigurasi')->first();
    	$model 	= new Berita_model();
		$berita = $model->listing();

        // Add S3 URLs to each berita
        foreach ($berita as $item) {
            if ($item->gambar) {
                $item->gambar_url = $this->getImageUrl($item->gambar);
                $item->thumbnail_url = $this->getThumbnailUrl($item->gambar);
            }
        }

        $data = array(  'title'     => 'Berita dan Update',
                        'deskripsi' => 'Berita dan Update',
                        'keywords'  => 'Berita dan Update',
                        'site_config' => $site,
                        'site'		=> $site,
                        'berita'	=> $berita,
                        'beritas'    => $berita
                    );
        return view('berita.index',$data);
    }

    // Beritapage
    public function kategori($slug_kategori)
    {
        Paginator::useBootstrap();
        $site       = DB::table('konfigurasi')->first();
        $kategori   = DB::table('kategori')->where('slug_kategori',$slug_kategori)->first();
         if(!$kategori)
        {
            return redirect('berita');
        }
        $id_kategori= $kategori->id_kategori;
        $model      = new Berita_model();
        $berita     = $model->kategori_depan($id_kategori);


        $data = array(  'title'     => $kategori->nama_kategori,
                        'deskripsi' => $kategori->nama_kategori,
                        'keywords'  => $kategori->nama_kategori,
                        'site_config' => $site,
                        'site'      => $site,
                        'berita'    => $berita,
                        'beritas'    => $berita
                    );
        return view('berita.index',$data);
    }

    // kontak
    public function layanan($slug_berita)
    {
        Paginator::useBootstrap();
        $site   = DB::table('konfigurasi')->first();
        $model  = new Berita_model();
        $berita = $model->read($slug_berita);
        $layanan = DB::table('berita')->where(array('jenis_berita' => 'Layanan','status_berita' => 'Publish'))->orderBy('urutan', 'ASC')->get();
        if(!$berita)
        {
            return redirect('berita');
        }

        $data = array(  'title'     => $berita->judul_berita,
                        'deskripsi' => $berita->judul_berita,
                        'keywords'  => $berita->judul_berita,
                        'site'      => $site,
                        'berita'    => $berita,
                        'layanan'   => $layanan,
                        'content'   => 'berita/layanan'
                    );
        return view('layout/wrapper',$data);
    }

    // kontak
    public function terjadi($slug_berita)
    {
        Paginator::useBootstrap();
        $site   = DB::table('konfigurasi')->first();
        $model  = new Berita_model();
        $berita = $model->read($slug_berita);
        $layanan = DB::table('berita')->where(array('jenis_berita' => 'Layanan','status_berita' => 'Publish'))->orderBy('urutan', 'ASC')->get();
        if(!$berita)
        {
            return redirect('berita');
        }

        $data = array(  'title'     => $berita->judul_berita,
                        'deskripsi' => $berita->judul_berita,
                        'keywords'  => $berita->judul_berita,
                        'site'      => $site,
                        'berita'    => $berita,
                        'layanan'   => $layanan,
                        'content'   => 'berita/terjadi'
                    );
        return view('layout/wrapper',$data);
    }

    // kontak
    public function read($slug_berita)
    {
       
        Paginator::useBootstrap();
        $site   = DB::table('konfigurasi')->first();
        $slider = DB::table('galeri')->where('jenis_galeri','Beritapage')->orderBy('id_galeri', 'DESC')->first();
        // $berita = DB::table('berita')->where('status_berita','Publish')->orderBy('id_berita', 'DESC')->get();
        $model  = new Berita_model();
        $read   = $model->read($slug_berita);
        if(!$read)
        {
            return redirect('berita');
        }

        // Add S3 URL
        if ($read->gambar) {
            $read->gambar_url = $this->getImageUrl($read->gambar);
        }

        $data = array(  'title'     => $read->judul_berita,
                        'deskripsi' => $read->judul_berita,
                        'keywords'  => $read->judul_berita,
                        'slider'    => $slider,
                        'site_config' => $site,
                        'read'      => $read
                    );
        return view('berita.read',$data);
    }

    /**
     * Helper function to get image URL from S3
     */
    private function getImageUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            // Check if file exists in S3
            if (Storage::disk('s3')->exists($path)) {
                return Storage::disk('s3')->url($path);
            }
            // Handle old paths that might still be in database (for backward compatibility)
            // Try to find in old local storage
            if (strpos($path, 'assets/upload/image/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // Return null if file doesn't exist
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Helper function to get thumbnail URL from S3
     */
    private function getThumbnailUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            // For thumbnails, check if thumbnail exists in S3
            $thumbnailPath = 'assets/upload/image/thumbs/' . basename($path);
            if (Storage::disk('s3')->exists($thumbnailPath)) {
                return Storage::disk('s3')->url($thumbnailPath);
            }
            // If no thumbnail, return main image URL
            return $this->getImageUrl($path);
        } catch (\Exception $e) {
            return null;
        }
    }
}