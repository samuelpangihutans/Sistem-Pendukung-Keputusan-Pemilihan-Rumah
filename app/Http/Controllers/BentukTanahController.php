<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Bentuk_tanah;

class BentukTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bentuk_tanah=Bentuk_tanah::all();
        return view('Bentuk_tanah/index')->with('bentuk_tanah',$bentuk_tanah);
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

        $bentuk_tanah=new Bentuk_tanah;
        $bentuk_tanah->nama=$request->input('nama');
        $bentuk_tanah->deskripsi=$request->input('deskripsi');
        $bentuk_tanah->save();

        return redirect('/bentukTanah')->with('success','bentuk tanah ditambahkan');
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
        $bentuk_tanah=Bentuk_tanah::find($id);
        return view('Bentuk_tanah.edit')->with('bentuk_tanah',$bentuk_tanah);
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

        $bentuk_tanah=Bentuk_tanah::find($id);
        $bentuk_tanah->nama=$request->input('nama');
        $bentuk_tanah->deskripsi=$request->input('deskripsi');
        $bentuk_tanah->save();

        return redirect('/bentukTanah')->with('success','bentuk tanah ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bentuk_tanah = Bentuk_tanah::find($id);
        $bentuk_tanah->delete();
        return redirect('/bentukTanah')->with('success','bentuk tanah berhasil dihapus');
    }
}
