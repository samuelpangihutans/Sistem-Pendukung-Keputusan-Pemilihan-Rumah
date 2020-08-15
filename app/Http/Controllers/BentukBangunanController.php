<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Bentuk_bangunan;

class BentukBangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bentuk_bangunan=Bentuk_bangunan::all();
        return view('Bentuk_bangunan/index')->with('bentuk_bangunan',$bentuk_bangunan);
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
        ]);

        $bentuk_bangunan=new Bentuk_bangunan;
        $bentuk_bangunan->nama=$request->input('nama');
        $bentuk_bangunan->save();

        return redirect('/bentukBangunan')->with('success','bentuk bangunan ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bentuk_bangunan=Bentuk_bangunan::find($id);
        return view('Bentuk_bangunan.edit')->with('bentuk_bangunan',$bentuk_bangunan);
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

        $bentuk_bangunan=Bentuk_bangunan::find($id);
        $bentuk_bangunan->nama=$request->input('nama');
        $bentuk_bangunan->save();

        return redirect('/bentukBangunan')->with('success','bentuk bangunan ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bentuk_bangunan = Bentuk_bangunan::find($id);
        $bentuk_bangunan->delete();
        return redirect('/bentukBangunan')->with('success','bentuk bangunan berhasil dihapus');
    }
}
