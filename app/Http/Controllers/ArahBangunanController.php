<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Arah_bangunan;

class ArahBangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arah_bangunan=Arah_bangunan::all();
        return view('Arah_bangunan/index')->with('arah_bangunan',$arah_bangunan);
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
            'nama'=>'required',
            'deskripsi'=>'required',
        ]);

        $arah_bangunan=new Arah_bangunan;
        $arah_bangunan->nama=$request->input('nama');
        $arah_bangunan->deskripsi=$request->input('deskripsi');
        $arah_bangunan->save();

        return redirect('/arahBangunan')->with('success','arah bangunan ditambahkan');
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
        $arah_bangunan=Arah_bangunan::find($id);
        return view('arah_bangunan.edit')->with('arah_bangunan',$arah_bangunan);
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
        $this->validate($request,[
            'nama'=>'required',
            'deskripsi'=>'required',
        ]);

        $arah_bangunan=Arah_bangunan::find($id);
        $arah_bangunan->nama=$request->input('nama');
        $arah_bangunan->deskripsi=$request->input('deskripsi');
        $arah_bangunan->save();

        return redirect('/arahBangunan')->with('success','arah bangunan ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arah_bangunan = Arah_bangunan::find($id);
        $arah_bangunan->delete();
        return redirect('/arahBangunan')->with('success','arah bangunan berhasil dihapus');
    }
}
