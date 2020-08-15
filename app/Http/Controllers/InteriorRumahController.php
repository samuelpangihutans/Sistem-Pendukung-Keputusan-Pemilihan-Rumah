<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Interior_rumah;

class InteriorRumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interior_rumah=Interior_rumah::all();
        return view('Interior_rumah/index')->with('interior_rumah',$interior_rumah);
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

        $interior_rumah=new Interior_rumah;
        $interior_rumah->nama=$request->input('nama');
        $interior_rumah->save();

        return redirect('/interiorRumah')->with('success','interior rumah ditambahkan');
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
        $interior_rumah=Interior_rumah::find($id);
        return view('Interior_rumah.edit')->with('interior_rumah',$interior_rumah);
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

        $interior_rumah=Interior_rumah::find($id);
        $interior_rumah->nama=$request->input('nama');
        $interior_rumah->save();

        return redirect('/interiorRumah')->with('success','interior rumah ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interior_rumah = Interior_rumah::find($id);
        $interior_rumah->delete();
        return redirect('/interiorRumah')->with('success','interior rumah berhasil dihapus');
    }
}
