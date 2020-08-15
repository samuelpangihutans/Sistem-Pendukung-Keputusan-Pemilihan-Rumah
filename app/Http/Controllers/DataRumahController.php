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

class DataRumahController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rumah= Rumah::orderBy('id')->paginate(10);
        $kecamatan= Kecamatan::all();
        $sertifikat= Sertifikat::all();
        $interior_rumah=Interior_rumah::all();
        $arah_bangunan=Arah_bangunan::all();
        $bentuk_bangunan=Bentuk_bangunan::all();
        $bentuk_tanah=Bentuk_tanah::all();
        return view('Admin/KelolaDataRumah')
        ->with('rumah',$rumah)
        ->with('kecamatan',$kecamatan)
        ->with('sertifikat',$sertifikat)
        ->with('interior_rumah',$interior_rumah)
        ->with('arah_bangunan',$arah_bangunan)
        ->with('bentuk_bangunan',$bentuk_bangunan)
        ->with('bentuk_tanah',$bentuk_tanah);
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
            'alamat'=>'required',
            'rt'=>'required',
            'rw'=>'required',
            'kecamatan'=>'required|not_in:0',
            'harga'=>'required',
            'ltanah'=>'required',
            'lbangunan'=>'required',
            'jlantai'=>'required',
            'jktidur'=>'required',
            'jkmandi'=>'required',
            'dlistrik'=>'required',
            'sertifikat'=>'required|not_in:0',
            'nomor_telepon'=>'required'
        ]);

        // masuk ke database

        $rumah=new Rumah;

        $rumah->alamat=$request->input('alamat');
        $rumah->rt=$request->input('rt');
        $rumah->rw=$request->input('rw');
        $rumah->id_kecamatan=$request->input('kecamatan');
        $rumah->harga=$request->input('harga');
        $rumah->luas_tanah=$request->input('ltanah');
        $rumah->luas_bangunan=$request->input('lbangunan');
        $rumah->jumlah_lantai=$request->input('jlantai');
        $rumah->jumlah_kamar_tidur=$request->input('jktidur');
        $rumah->jumlah_kamar_mandi=$request->input('jkmandi');
        $rumah->daya_listrik=$request->input('dlistrik');
        $rumah->id_sertifikat=$request->input('sertifikat');
        $rumah->nomor_telepon=$request->input('nomor_telepon');
        $rumah->deskripsi=$request->input('deskripsi');

        $rumah->dekat_pasar=$request->input('dekat_pasar');
        $rumah->dekat_sekolah=$request->input('dekat_sekolah');
        $rumah->dekat_pusat_perbelanjaan=$request->input('dekat_pusat_perbelanjaan');
        $rumah->dekat_sarana_olahraga=$request->input('dekat_sarana_olahraga');
        $rumah->bebas_banjir=$request->input('bebas_banjir'); 
        $rumah->daerah_sepi=$request->input('daerah_sepi');
        $rumah->daerah_rindang=$request->input('daerah_rindang');
        $rumah->status_jalan=$request->input('status_jalan');

        $rumah->garasi=$request->input('garasi');
        $rumah->carport=$request->input('carport');
        $rumah->id_interior_rumah=$request->input('interior_rumah');
        $rumah->id_arah_bangunan=$request->input('arah_bangunan');
        $rumah->id_bentuk_bangunan=$request->input('bentuk_bangunan');
        $rumah->id_bentuk_tanah=$request->input('bentuk_tanah');
        $rumah->keamanan=$request->input('keamanan');
        $rumah->petugas_kebersihan=$request->input('petugas_kebersihan');
        $rumah->halaman=$request->input('halaman');
      
    

        $rumah->save();


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
                $gambar->id_rumah=$rumah->id; 
                $gambar->save();  
            }
        }

        return redirect('/kelolaDataRumah')->with('success','rumah ditambahkan');
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
        ->where('rumah.id','=',$id)
        ->get();
        $gambar= DB::table('gambar')->where('id_rumah',$id)->get();
        return view('rumah.show')->with('rumah',$rumah)->with('gambar',$gambar);
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
        $kecamatan= Kecamatan::all();
        $sertifikat= Sertifikat::all();
        $interior_rumah=Interior_rumah::all();
        $arah_bangunan=Arah_bangunan::all();
        $bentuk_bangunan=Bentuk_bangunan::all();
        $bentuk_tanah=Bentuk_tanah::all();
        $gambar= DB::table('gambar')->where('id_rumah',$id)->get();
        return view('rumah.edit')
        ->with('rumah',$rumah)
        ->with('kecamatan',$kecamatan)
        ->with('sertifikat',$sertifikat)
        ->with('interior_rumah',$interior_rumah)
        ->with('arah_bangunan',$arah_bangunan)
        ->with('bentuk_bangunan',$bentuk_bangunan)
        ->with('bentuk_tanah',$bentuk_tanah)
        ->with('gambar',$gambar);
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
            'alamat'=>'required',
            'rt'=>'required',
            'rw'=>'required',
            'kecamatan'=>'required|not_in:0',
            'harga'=>'required',
            'ltanah'=>'required',
            'lbangunan'=>'required',
            'jlantai'=>'required',
            'jktidur'=>'required',
            'jkmandi'=>'required',
            'dlistrik'=>'required',
            'sertifikat'=>'required|not_in:0',
            'nomor_telepon'=>'required'
        ]);

        //masuk ke database

        $rumah= Rumah::find($id);
        $rumah->alamat=$request->input('alamat');
        $rumah->rt=$request->input('rt');
        $rumah->rw=$request->input('rw');
        $rumah->id_kecamatan=$request->input('kecamatan');
        $rumah->harga=$request->input('harga');
        $rumah->luas_tanah=$request->input('ltanah');
        $rumah->luas_bangunan=$request->input('lbangunan');
        $rumah->jumlah_lantai=$request->input('jlantai');
        $rumah->jumlah_kamar_tidur=$request->input('jktidur');
        $rumah->jumlah_kamar_mandi=$request->input('jkmandi');
        $rumah->daya_listrik=$request->input('dlistrik');
        $rumah->id_sertifikat=$request->input('sertifikat');
        $rumah->nomor_telepon=$request->input('nomor_telepon');
        $rumah->deskripsi=$request->input('deskripsi');

        $rumah->dekat_pasar=$request->input('dekat_pasar');
        $rumah->dekat_sekolah=$request->input('dekat_sekolah');
        $rumah->dekat_pusat_perbelanjaan=$request->input('dekat_pusat_perbelanjaan');
        $rumah->dekat_sarana_olahraga=$request->input('dekat_sarana_olahraga');
        $rumah->bebas_banjir=$request->input('bebas_banjir'); 
        $rumah->daerah_sepi=$request->input('daerah_sepi');
        $rumah->daerah_rindang=$request->input('daerah_rindang');
        $rumah->status_jalan=$request->input('status_jalan');

        $rumah->garasi=$request->input('garasi');
        $rumah->carport=$request->input('carport');
        $rumah->id_interior_rumah=$request->input('interior_rumah');
        $rumah->id_arah_bangunan=$request->input('arah_bangunan');
        $rumah->id_bentuk_bangunan=$request->input('bentuk_bangunan');
        $rumah->id_bentuk_tanah=$request->input('bentuk_tanah');
        $rumah->keamanan=$request->input('keamanan');
        $rumah->petugas_kebersihan=$request->input('petugas_kebersihan');
        $rumah->halaman=$request->input('halaman');
        
        $rumah->save();

        return redirect('/dataRumah'.'/'.$rumah->id.'/edit')->with('success','rumah berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rumah = Rumah::find($id);
        $rumah->delete();
        return redirect('/kelolaDataRumah')->with('success','rumah berhasil dihapus');
    }

    public function ubahStatus($id){
         $rumah = Rumah::find($id);
        if($rumah->status==1){
             $rumah->status=0;
        }
        else if($rumah->status==0){
             $rumah->status=1;
         }
        $rumah->save();
        return redirect('/kelolaDataRumah')->with('success','status berhasil diubah');
       
    }

    public function filter(Request $request){
        
        $hmin=0;
        $hmax=0;
        $ltmin=0;
        $ltmax=0;
        $lbmin=0;
        $lbmax=0;

        $kec=$request->input('fkecamatan');
        // Harga
        if($request->input('fharga')==0){
            $hmin=0;
            $hmax=2000000000;
        }
        else if($request->input('fharga')==1){
            $hmin=0;
            $hmax=100000;
        }
        else if($request->input('fharga')==2){
            $hmin=100000;
            $hmax=500000;
        }
        else if($request->input('fharga')==3){
            $hmin=500000;
            $hmax=1000000;
        }
        else if($request->input('fharga')==4){
            $hmin=1000000;
            $hmax=5000000;
        }
        else if($request->input('fharga')==5){
            $hmin=5000000;
            $hmax=2000000000;
        }

        

        // Luas Tanah
        if($request->input('fltanah')==0){
            $ltmin=0;
            $ltmax=100000;
        }
        else if($request->input('fltanah')==1){
            $ltmin=0;
            $ltmax=100;
        }
        else if($request->input('fltanah')==2){
            $ltmin=100;
            $ltmax=200;
        }
        else if($request->input('fltanah')==3){
            $ltmin=200;
            $ltmax=300;
        }
        else if($request->input('fltanah')==4){
            $ltmin=300;
            $ltmax=100000;
        }

        // luas Bangunan
        if($request->input('flbangunan')==0){
            $lbmin=0;
            $lbmax=100000;
        }
        else if($request->input('flbangunan')==1){
            $lbmin=0;
            $lbmax=100;
        }
        else if($request->input('flbangunan')==2){
            $lbmin=100;
            $lbmax=200;
        }
        else if($request->input('flbangunan')==3){
            $lbmin=200;
            $lbmax=300;
        }
        else if($request->input('flbangunan')==4){
            $lbmin=300;
            $lbmax=100000;
        }

        // Query 
        if($request->input('fkecamatan')==0){
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
            ->where('status','=',1)
            ->where('luas_tanah','>=',$ltmin)
            ->where('luas_tanah','<=',$ltmax)
            ->where('luas_bangunan','>=',$lbmin)
            ->where('luas_bangunan','<=',$lbmax)
            ->whereRaw('harga/1000 >='.$hmin)
            ->whereRaw('harga/1000 <='.$hmax)
            ->paginate(4)
            ->appends('fltanah',$request->fltanah)
            ->appends('flbangunan',$request->flbangunan)
            ->appends('fharga',$request->fharga);
        }
        else{
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
            ->where('status','=',1)
            ->where('id_kecamatan',$kec)
            ->where('luas_tanah','>=',$ltmin)
            ->where('luas_tanah','<=',$ltmax)
            ->where('luas_bangunan','>=',$lbmin)
            ->where('luas_bangunan','<=',$lbmax)
            ->whereRaw('harga/1000 >='.$hmin)
            ->whereRaw('harga/1000 <='.$hmax)
            ->paginate(4)
            ->appends('fltanah',$request->fltanah)
            ->appends('flbangunan',$request->flbangunan)
            ->appends('fkecamatan',$request->fkecamatan)
            ->appends('fharga',$request->fharga);
        }
        $kecamatan=Kecamatan::all();
        return view('home')->with('rumah',$rumah)->with('kecamatan',$kecamatan);
    }
}
