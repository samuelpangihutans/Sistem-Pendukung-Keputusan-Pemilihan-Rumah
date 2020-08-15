<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Kecamatan;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan=Kecamatan::all();
        return view('Kecamatan/index')->with('kecamatan',$kecamatan);
    
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
            'nama'=>'required'
        ]);

        $kecamatan=new Kecamatan;
        $kecamatan->nama=$request->input('nama');
        $kecamatan->save();

        return redirect('/kecamatan')->with('success','kecamatan ditambahkan');
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
        $kecamatan=Kecamatan::find($id);
        return view('Kecamatan.edit')->with('kecamatan',$kecamatan);
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
            'nama'=>'required'
        ]);

        $kecamatan=Kecamatan::find($id);
        $kecamatan->nama=$request->input('nama');
        $kecamatan->save();

        return redirect('/kecamatan')->with('success','kecamatan ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecamatan = Kecamatan::find($id);
        $kecamatan->delete();
        return redirect('/kecamatan')->with('success','kecamatan berhasil dihapus');
    }
}
