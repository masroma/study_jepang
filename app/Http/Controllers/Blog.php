<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BlogPost;

class Blog extends Controller
{
    // Index - Menampilkan semua artikel blog
    public function index()
    {
        try {
            $site_config = DB::table('konfigurasi')->first();
            
            // Ambil semua artikel yang publish dengan pagination
            $articles = BlogPost::published()
                                ->latest()
                                ->paginate(9);
            
            // Ambil artikel terbaru untuk featured
            $featured = BlogPost::published()
                               ->latest()
                               ->first();
            
            // Ambil artikel per kategori untuk sidebar
            $categories = [
                'Pendidikan' => BlogPost::published()->byCategory('Pendidikan')->count(),
                'Panduan' => BlogPost::published()->byCategory('Panduan')->count(),
                'Karier' => BlogPost::published()->byCategory('Karier')->count(),
                'Budaya' => BlogPost::published()->byCategory('Budaya')->count(),
                'Tips & Trik' => BlogPost::published()->byCategory('Tips & Trik')->count(),
                'Lifestyle' => BlogPost::published()->byCategory('Lifestyle')->count(),
            ];

            $data = [
                'title'         => 'Blog - ' . $site_config->namaweb,
                'deskripsi'     => 'Blog - Tips dan informasi seputar studi dan bekerja di Jepang',
                'keywords'      => 'Blog, Jepang, studi, karier, tips',
                'site_config'   => $site_config,
                'articles'      => $articles,
                'featured'      => $featured,
                'categories'    => $categories,
                'content'       => 'blog'
            ];
            return view('blog', $data);
        } catch (\Exception $e) {
            // Fallback if something fails
            \Log::error('Blog@index Error: ' . $e->getMessage());
            return redirect('/berita')->with('error', 'Blog tidak tersedia');
        }
    }

    // Detail artikel
    public function detail($slug)
    {
        $site_config = DB::table('konfigurasi')->first();
        
        // Ambil artikel berdasarkan slug
        $article = BlogPost::where('slug', $slug)
                          ->published()
                          ->firstOrFail();
        
        // Increment views
        $article->incrementViews();
        
        // Ambil artikel terkait (berdasarkan kategori)
        $related = BlogPost::where('kategori', $article->kategori)
                          ->where('id_post', '!=', $article->id_post)
                          ->published()
                          ->latest()
                          ->limit(3)
                          ->get();

        $data = [
            'title'         => $article->judul . ' - ' . $site_config->namaweb,
            'deskripsi'     => $article->deskripsi_singkat,
            'keywords'      => $article->judul . ', ' . $article->kategori,
            'site_config'   => $site_config,
            'article'       => $article,
            'related'       => $related,
            'content'       => 'blog/detail'
        ];
        return view('blog', $data);
    }

    // Filter by kategori
    public function byCategory($kategori)
    {
        $site_config = DB::table('konfigurasi')->first();
        
        $articles = BlogPost::byCategory($kategori)
                           ->published()
                           ->latest()
                           ->paginate(9);

        $data = [
            'title'         => $kategori . ' - Blog - ' . $site_config->namaweb,
            'deskripsi'     => 'Artikel kategori ' . $kategori,
            'keywords'      => $kategori . ', Blog, Jepang',
            'site_config'   => $site_config,
            'articles'      => $articles,
            'current_category' => $kategori,
            'content'       => 'blog'
        ];
        return view('blog', $data);
    }

    // Search artikel
    public function search(Request $request)
    {
        $site_config = DB::table('konfigurasi')->first();
        $query = $request->input('q');
        
        $articles = BlogPost::where('judul', 'LIKE', "%{$query}%")
                           ->orWhere('konten', 'LIKE', "%{$query}%")
                           ->orWhere('kategori', 'LIKE', "%{$query}%")
                           ->published()
                           ->latest()
                           ->paginate(9);

        $data = [
            'title'         => 'Hasil Pencarian: ' . $query,
            'deskripsi'     => 'Hasil pencarian untuk: ' . $query,
            'keywords'      => $query . ', Blog, Jepang',
            'site_config'   => $site_config,
            'articles'      => $articles,
            'search_query'  => $query,
            'content'       => 'blog'
        ];
        return view('blog', $data);
    }
}
