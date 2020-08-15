<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\gambar;
use App\Rumah;
use DB;
use App\Quotation;

class GambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'gambar'=>'required'
        ]);

        if($request->hasFile('gambar')){

            $files=$request->file('gambar');

            foreach ($files as $file){
                $gambar=new gambar;
                //mengambil filename dengan ekstensi
                $fileNameWithExt = $file->getClientOriginalName();
                //get filename
                $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //get ext
                $extension=$file->getClientOriginalExtension();
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                //upload Image
                $path=$file->storeAs('public/gambar',$fileNameToStore);

                $gambar->url_gambar=$fileNameToStore;
                $gambar->id_rumah=$request->input('id_rumah');
                $gambar->save();  
            }

            
        }
        return redirect('/gambar'.'/'.$request->input('id_rumah').'/edit')->with('success','Gambar Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rumah= Rumah::find($id);
        $gambar= DB::table('gambar')->where('id_rumah',$id)->paginate(3);
        
        return view('rumah.editGambar')->with('rumah',$rumah)->with('gambar',$gambar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = Gambar::find($id);
        $id_rumah=(int)DB::table('gambar')->where('id',$id)->pluck('id_rumah')->first();

        if($gambar->url_gambar != 'noimage.jpg'){
            //hapus gambar
            Storage::delete('public/gambar/'.$gambar->url_gambar);
        }

        $gambar->delete();

        return redirect('/gambar'.'/'.$id_rumah.'/edit')->with('success','Gambar Berhasil dihapus');
    }
}
