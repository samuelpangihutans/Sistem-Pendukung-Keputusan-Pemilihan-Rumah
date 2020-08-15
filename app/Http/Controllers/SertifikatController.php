<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Sertifikat;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sertifikat=Sertifikat::all();
        return view('Sertifikat/index')->with('sertifikat',$sertifikat);
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

        $sertifikat=new Sertifikat;
        $sertifikat->nama=$request->input('nama');
        $sertifikat->save();

        return redirect('/sertifikat')->with('success','sertifikat ditambahkan');
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
        $sertifikat=Sertifikat::find($id);
        return view('Sertifikat.edit')->with('sertifikat',$sertifikat);
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
        ]);

        $sertifikat=Sertifikat::find($id);
        $sertifikat->nama=$request->input('nama');
        $sertifikat->save();

        return redirect('/sertifikat')->with('success','sertifikat ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sertifikat = Sertifikat::find($id);
        $sertifikat->delete();
        return redirect('/sertifikat')->with('success','sertifikat berhasil dihapus');
    }
}
