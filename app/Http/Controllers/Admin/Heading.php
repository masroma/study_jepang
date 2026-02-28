<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage;

class Heading extends Controller
{
    // Index
    public function index()
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
		$heading 	= DB::table('heading')->orderBy('judul_heading','ASC')->get();

		$data = array(  'title'         => 'Setting Header',
						'heading'	    => $heading,
                        'content'       => 'admin/heading/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
					        'judul_heading' => 'required|unique:heading',
                            'gambar'        => 'required|file|image|mimes:jpeg,png,jpg|max:8024',
					        ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        
        // Upload original image to S3
        $s3Path = 'assets/upload/image/' . $input['nama_file'];
        Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
        
        // Create thumbnail and upload to S3
        $img = Image::make($image->getRealPath())->resize(150, 150);
        $thumbnailPath = 'assets/upload/image/thumbs/' . $input['nama_file'];
        Storage::disk('public')->put($thumbnailPath, $img->encode()->getEncoded(), 'public');
        // END UPLOAD
        DB::table('heading')->insert([
            'judul_heading' => $request->judul_heading,
            'keterangan'    => $request->keterangan,
            'gambar'        => $input['nama_file'],
            'halaman'       => $request->halaman
        ]);
        return redirect('admin/heading')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
					        'judul_heading' => 'required',
					        'judul_heading'               => 'required',
                            'gambar'               => 'file|image|mimes:jpeg,png,jpg|max:8024',
					        ]);
        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            // UPLOAD START
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            
            // Upload original image to S3
            $s3Path = 'assets/upload/image/' . $input['nama_file'];
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            
            // Create thumbnail and upload to S3
            $img = Image::make($image->getRealPath())->resize(150, 150);
            $thumbnailPath = 'assets/upload/image/thumbs/' . $input['nama_file'];
            Storage::disk('public')->put($thumbnailPath, $img->encode()->getEncoded(), 'public');
            // END UPLOAD
            $slug_heading = Str::slug($request->judul_heading, '-');
            DB::table('heading')->where('id_heading',$request->id_heading)->update([
                'judul_heading' => $request->judul_heading,
                'keterangan'    => $request->keterangan,
                'gambar'        => $input['nama_file'],
                'halaman'       => $request->halaman
            ]);
        }else{
            $slug_heading = Str::slug($request->judul_heading, '-');
            DB::table('heading')->where('id_heading',$request->id_heading)->update([
                'judul_heading' => $request->judul_heading,
                'keterangan'    => $request->keterangan,
                // 'gambar'        => $input['nama_file'],
                'halaman'       => $request->halaman
            ]);
        }
        return redirect('admin/heading')->with(['sukses' => 'Data telah diupdate']);
    }

    // Delete
    public function delete($id_heading)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	DB::table('heading')->where('id_heading',$id_heading)->delete();
    	return redirect('admin/heading')->with(['sukses' => 'Data telah dihapus']);
    }
}
