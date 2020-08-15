<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rumah;
use App\gambar;
use App\kecamatan;
use App\sertifikat;
use App\arah_bangunan;
use App\bentuk_bangunan;
use App\bentuk_tanah;
use App\interior_rumah;
use DB;
use App\Quotation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kecamatan=Kecamatan::all();
        $rumah=DB::table('rumah')
        ->leftJoin('kecamatan','rumah.id_kecamatan','=','kecamatan.id')
        ->leftJoin('sertifikat','rumah.id_sertifikat','=','sertifikat.id')
        ->leftJoin('interior_rumah','rumah.id_interior_rumah','=','interior_rumah.id')
        ->leftJoin('arah_bangunan','rumah.id_arah_bangunan','=','arah_bangunan.id')
        ->leftJoin('bentuk_bangunan','rumah.id_bentuk_bangunan','=','bentuk_bangunan.id')
        ->leftJoin('bentuk_tanah','rumah.id_bentuk_tanah','=','bentuk_tanah.id')
        ->select(
        'rumah.*',
        'kecamatan.nama as kecamatan',
        'sertifikat.nama as sertifikat',
        'interior_rumah.nama as interior_rumah',
        'arah_bangunan.nama as arah_bangunan',
        'bentuk_bangunan.nama as bentuk_bangunan',
        'bentuk_tanah.nama as bentuk_tanah'
        )
        ->where('rumah.status','=',1)
        ->orderby('id')->paginate(4);
        return view('home')->with('rumah',$rumah)->with('kecamatan',$kecamatan);
    }
}
