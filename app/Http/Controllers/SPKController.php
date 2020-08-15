<?php
namespace App\Http\Controllers;
use DB;
use App\Quotation;
use App\Rumah;
use App\gambar;
use App\kecamatan;
use App\sertifikat;
use App\arah_bangunan;
use App\bentuk_bangunan;
use App\bentuk_tanah;
use App\interior_rumah;
use Illuminate\Http\Request;
use Session;


class SPKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan=Kecamatan::all();
        return view('spk.index')->with('kecamatan',$kecamatan);
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
        //
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
        //
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
        //
    }

    public function spk1(Request $request){

        // Tahap 1 SPK , SECC
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
            $hmax=5000000;;
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
            ->get();
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
            ->get();
        }
        Session::put('listRumah', $rumah);
        $kecamatan=Kecamatan::all();
        $sertifikat=sertifikat::all();
        $interior_rumah=interior_rumah::all();
        $arah_bangunan=arah_bangunan::all();
        $bentuk_bangunan=bentuk_bangunan::all();
        $bentuk_tanah=bentuk_tanah::all();

        if(count($rumah)==0){
            return view('spk.index')->with('kecamatan',$kecamatan)->withErrors('Tidak ada rumah yang menjadi kandidat');
        }
        else{
            return view('spk.spk2')
            ->with('rumah',$rumah)
            ->with('sertifikat',$sertifikat)
            ->with('interior_rumah',$interior_rumah)
            ->with('arah_bangunan',$arah_bangunan)
            ->with('bentuk_bangunan',$bentuk_bangunan)
            ->with('bentuk_tanah',$bentuk_tanah)
            ;
        }
    }

    public function spk2(Request $request){
        $data=array();

        //untuk faktor objektif
        if($request->input('harga')==1){
            array_push($data,array(
                'name'=>'harga',
                'view'=>'Harga',
                'faktor'=>'objektif'
            ));
        }
        if($request->input('luas_tanah')==1){
            array_push($data,array(
                'name'=>'luas_tanah',
                'view'=>'Luas Tanah',
                'faktor'=>'objektif'
            ));
        }
        if($request->input('luas_bangunan')==1){
            array_push($data,array(
                'name'=>'luas_bangunan',
                'view'=>'Luas Bangunan',
                'faktor'=>'objektif'
            ));
        }
        if($request->input('jumlah_kamar_tidur')==1){
            array_push($data,array(
                'name'=>'jumlah_kamar_tidur',
                'view'=>'Jumlah Kamar Tidur',
                'faktor'=>'objektif'
            ));
        }
        if($request->input('jumlah_kamar_mandi')==1){
            array_push($data,array(
                'name'=>'jumlah_kamar_mandi',
                'view'=>'Jumlah Kamar Mandi',
                'faktor'=>'objektif'
            ));
        }
        if($request->input('kapasitas_kendaraan')==1){
            array_push($data,array(
                'name'=>'kapasitas_kendaraan',
                'view'=>'Kapasitas Penyimpanan Kendaraan',
                'faktor'=>'objektif'
            ));
        }
        if($request->input('daya_listrik')==1){
            array_push($data,array(
                'name'=>'daya_listrik',
                'view'=>'Daya Listrik',
                'faktor'=>'objektif'
            ));
        }


        //untuk faktor subjektif
        if($request->input('garasi')==1){
            array_push($data,array(
                'name'=>'garasi',
                'view'=>'Memiliki Garasi',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('carport')==1){
            array_push($data,array(
                'name'=>'carport',
                'view'=>'Memiliki Carport',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('keamanan')==1){
            array_push($data,array(
                'name'=>'keamanan',
                'view'=>'Memiliki Keamanan',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('halaman')==1){
            array_push($data,array(
                'name'=>'halaman',
                'view'=>'Memiliki Halaman',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('petugas_kebersihan')==1){
            array_push($data,array(
                'name'=>'petugas_kebersihan',
                'view'=>'Memiliki Petugas Kebersihan',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('dekat_pasar')==1){
            array_push($data,array(
                'name'=>'dekat_pasar',
                'view'=>'Lokasi Dekat Dengan Pasar',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('dekat_sekolah')==1){
            array_push($data,array(
                'name'=>'dekat_sekolah',
                'view'=>'Lokasi Dekat Dengan Sekolah',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('dekat_pusat_perbelanjaan')==1){
            array_push($data,array(
                'name'=>'dekat_pusat_perbelanjaan',
                'view'=>'Lokasi Dekat Dengan Pusat Perbelanjaan',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('bebas_banjir')==1){
            array_push($data,array(
                'name'=>'bebas_banjir',
                'view'=>'Lokasi Bebas Banjir',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('dekat_sarana_olahraga')==1){
            array_push($data,array(
                'name'=>'dekat_sarana_olahraga',
                'view'=>'Lokasi Dekat Dengan Sarana Olahraga',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('daerah_sepi')==1){
            array_push($data,array(
                'name'=>'daerah_sepi',
                'view'=>'Daerah Sepi (tenang)',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('daerah_rindang')==1){
            array_push($data,array(
                'name'=>'daerah_rindang',
                'view'=>'Daerah Rindang',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('status_jalan')==1){
            array_push($data,array(
                'name'=>'status_jalan',
                'view'=>'Kondisi Jalan Bagus',
                'faktor'=>'subjektif'
            ));
        }
        if($request->input('sertifikat')!=0){
            array_push($data,array(
                'name'=>'sertifikat',
                'view'=>$request->input('sertifikat'),
                'faktor'=>'subjektif',
                'val'=>''
            ));
        }
        if($request->input('jumlah_lantai')!=0){
            array_push($data,array(
                'name'=>'jumlah_lantai',
                'view'=>$request->input('jumlah_lantai'),
                'faktor'=>'subjektif',
                'val'=>''
            ));
        }
        if($request->input('interior_rumah')!=0){
            array_push($data,array(
                'name'=>'interior_rumah',
                'view'=>$request->input('interior_rumah'),
                'faktor'=>'subjektif',
                'val'=>''
            ));
        }
        if($request->input('arah_bangunan')!=0){
            array_push($data,array(
                'name'=>'arah_bangunan',
                'view'=>$request->input('arah_bangunan'),
                'faktor'=>'subjektif',
                'val'=>''
            ));
        }
        if($request->input('bentuk_tanah')!=0){
            array_push($data,array(
                'name'=>'bentuk_tanah',
                'view'=>$request->input('bentuk_tanah'),
                'faktor'=>'subjektif',
                'val'=>''
            ));
        }
        if($request->input('bentuk_bangunan')!=0){
            array_push($data,array(
                'name'=>'bentuk_bangunan',
                'view'=>$request->input('bentuk_bangunan'),
                'faktor'=>'subjektif',
                'val'=>''
            ));
        }

    return view('spk.spk3')->with('data',$data);
    }

    public function spk3(Request $request){
      
        //mengambil data rumah hasil seleksi tahap 1 dari session.
        $rumah =Session::get('listRumah')->toArray();
        $rumah = json_decode(json_encode($rumah), true);
    
        //mengambil prioritas data
        $prioritas=$request->all();

        //validation
        $validate_array=array();
       
        $validate_array['k'] = 'required';
        
        $this->validate($request, $validate_array );

        //Dikelompokkan berdasarkan type faktor
        $subjektif=array();
        $objektif=array();
        $subjektifVal=array();
        $objektifVal=array();
        $k=0;
        $prior=0;

        foreach($prioritas as $key=> $val){
            if(
                $key=='harga'||
                $key=='luas_tanah'||
                $key=='luas_bangunan'||
                $key=='jumlah_kamar_tidur'||
                $key=='jumlah_kamar_mandi'||
                $key=='kapasitas_kendaraan'||
                $key=='daya_listrik'
            ){
                $objektif[$key]=$val;

            }
            else if($key=='k'){
                $k=$val;
            }
            else if($key=='prior'){
                $prior=$val;
            }
            else{
                if(
                    $key=='sertifikat_val' ||
                    $key=='jumlah_lantai_val' ||
                    $key=='interior_rumah_val'||
                    $key=='arah_bangunan_val' ||
                    $key=='bentuk_tanah_val' ||
                    $key=='bentuk_bangunan_val' 

                ){
                    $subjektifVal[$key]=$val;
                }
                else if(
                    $key=='harga_val' ||
                    $key=='luas_tanah_val' ||
                    $key=='luas_bangunan_val'||
                    $key=='jumlah_kamar_tidur_val' ||
                    $key=='jumlah_kamar_mandi_val' ||
                    $key=='kapasitas_kendaraan_val' ||
                    $key=='daya_listrik_val' 
                ){
                    $objektifVal[$key]=$val;
                }
                else{
                    $subjektif[$key]=$val;
                    if(is_null($subjektif[$key])){
                        $subjektif[$key]=999;
                    }
                    else{
                         $subjektif[$key]=$val;
                    }
                    
                }
            }
        }

        //Menghiuting OFI
        $ofi=$this->ofi($objektif,$rumah,$objektifVal);

        //Menghitung Matrix Subjektif Factor weight
        $subjektifMatrix=$this->factorWeight($subjektif);

        //Matrix Subjektif Factor Decision Weight
        $subjektifDecisionMatrix=$this->subjektifFactorDecisionWeight($subjektif,$subjektifVal,$rumah);

        //Menghitung SFM
        $sfm=$this->subjektifFactorMeassure($subjektif,$subjektifMatrix,$subjektifDecisionMatrix,$rumah);

        //Menghitung decision weight
        $dw=$this->decisionWeight($ofi,$sfm,$rumah,$k,$prior);

        //Mengambil Id Rumah Terbaik dan bobotnya
        $rumahTerbaik=$this->rumahTerbaik($dw);
        $counter=count($rumahTerbaik);
        $rumahFinal=array();
        
        //mengambil rumah terbaik dari database
   
        
            for($i=0;$i<$counter;$i++){
                $hasil=array();
                $hasil[0]=DB::table('rumah')
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
                ->where('rumah.id',$rumahTerbaik[$i][0])->get();
                $hasil[1]=$rumahTerbaik[$i][1];
                array_push($rumahFinal,$hasil);
            }
        
       

        return view('spk.spk4')->with('rumahFinal',$rumahFinal);
       
    }

    function factorWeight($data){
        $result=array();
        $counter=0;

        foreach($data as $key=> $val){
            $result[$key]['total']=0;
            $result[$key]['fw']=0;
        }

        if(count($data)==1){
            foreach($data as $key=> $val){
                $result[$key]['fw']=1;
            }
        }
        else{
            foreach($data as $key=> $val){
                foreach($data as $key2=> $val2){
                    if($key==$key2){
                        continue;
                    }
                    else{
                        if($val<$val2){
                            $result[$key][$key2]=1;
                            $result[$key]['total']=$result[$key]['total']+1;
                            $counter+=1;
                        }
                        else if($val>$val2){
                            $result[$key][$key2]=0;
                        }
                        else if($val==$val2){
                            $result[$key][$key2]=1;
                            $result[$key]['total']=$result[$key]['total']+1;
                            $counter+=1;
                        }
                        
                    }
                }
            }
            foreach($data as $key=> $val){
                if($result[$key]['total']==0){
                    $result[$key]['fw']=0;
                }
                else{
                    $result[$key]['fw']= $result[$key]['total']/$counter;
                }
            }
        }
        return $result;
    }

    function normalisasiCost($val,$min){
        if($val==0){
            return 0;
        }
        else{
            return $min/$val;
        }
    }

    function normalisasiBenefit($val,$max){
        return $val/$max;
    }

    function maxVal($rumah,$key){
        $maxVal=0;
        foreach($rumah as $krmh=>$valrmh){
          if($maxVal<$valrmh[$key]){
            $maxVal=$valrmh[$key];
          }
        } 
        return $maxVal;
    }

    function minVal($rumah,$key){
        $minVal=INF;
        foreach($rumah as $krmh=>$valrmh){
          if($minVal>$valrmh[$key] && $valrmh[$key]!=0){
            $minVal=$valrmh[$key];
          }
        } 
        return $minVal;
    }

    function minkapasitasKendaraan($rumah){
        $minVal=INF;
        foreach($rumah as $krmh=>$valrmh){
          if($minVal>$valrmh['garasi']+$valrmh['carport']&&$valrmh['garasi']+$valrmh['carport'] != 0){
            $minVal=$valrmh['garasi']+$valrmh['carport'];
          }
        } 
        return $minVal;
    }

    function maxkapasitasKendaraan($rumah){
        $maxVal=0;
        foreach($rumah as $krmh=>$valrmh){
            if($maxVal<$valrmh['garasi']+$valrmh['carport']){
              $maxVal=$valrmh['garasi']+$valrmh['carport'];
            }
          } 
          return $maxVal;
    }

    function ofi($objektif,$rumah,$objektifVal){
        //inisialisasi awal
        $result=array();
        $resultFinal=array();
        $minVal=Array();
        $maxVal=Array();
        $jmlhObjektif=count($objektif);

        //mencari nilai max dari setiap faktor objektif
        foreach($objektif as $key=>$val){
            if($key=='kapasitas_kendaraan'){
                $maxVal[$key]=$this->maxkapasitasKendaraan($rumah);
            }
            else{
                $maxVal[$key]=$this->maxVal($rumah,$key);
            }
        }

       //mencari nilai min dari setiap faktor objektif
        foreach($objektif as $key=>$val){
            if($key=='kapasitas_kendaraan'){
                $minVal[$key]=$this->minkapasitasKendaraan($rumah);
            }
            else{
                $minVal[$key]=$this->minVal($rumah,$key);
            }
        }

        //menginisialisasi ci dan / 1/ci
        foreach($objektif as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                $result[$key][$valrmh['id']]['ci']=0; 
                $result[$key][$valrmh['id']]['1/ci']=0; 
            }
        }

        //menghitung Ci dan 1/Ci
        foreach($objektif as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                 if($key=='kapasitas_kendaraan'){
                    $carport=$valrmh['carport'];
                    $garasi=$valrmh['garasi'];  
                    $total=$carport+$garasi;

                    if($objektifVal[$key.'_val']==1){
                        $ci=$this->normalisasiBenefit($total,$maxVal[$key]);
                    }
                    else{
                        $ci=$this->normalisasiCost($total,$minVal[$key]);
                    }
                   
                    if($ci>0){
                        $result[$key][$valrmh['id']]['ci']=$ci; 
                        $result[$key][$valrmh['id']]['1/ci']=1/$ci; 
                    }
                    else{
                        $result[$key][$valrmh['id']]['ci']=0; 
                        $result[$key][$valrmh['id']]['1/ci']=0; 
                    }
                   
                 }
                 else{
                    if($objektifVal[$key.'_val']==1){
                        $ci=$this->normalisasiBenefit($valrmh[$key],$maxVal[$key]);
                    }
                    else{
                        $ci=$this->normalisasiCost($valrmh[$key],$minVal[$key]);
                    }
                    
                    if($ci>0){
                        $result[$key][$valrmh['id']]['ci']=$ci; 
                        $result[$key][$valrmh['id']]['1/ci']=1/$ci;
                    }
                    else{
                        $result[$key][$valrmh['id']]['ci']=0; 
                        $result[$key][$valrmh['id']]['1/ci']=0; 
                    }
                    
                 }
            }  
        }
        //inisialisasi sigma dari 1/ci
        $sigma=array();
        foreach($objektif as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                $sigma[$key]=0;
            }
        }
        //menghitung sigma 1/ci
        foreach($objektif as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                $sigma[$key]+=$result[$key][$valrmh['id']]['1/ci'];
            }
        }

        
        //inisialisasi awal ofi
        foreach($rumah as $krmh=>$valrmh){
            $resultFinal[$valrmh['id']]=0; 
        }

        //untuk setiap faktor objektif , dijumlahkan ofinya 
        foreach ($result as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                if($result[$key][$valrmh['id']]['ci']*$sigma[$key]==0){
                    $resultFinal[$valrmh['id']]+=0;
                }
                else{
                    $resultFinal[$valrmh['id']]+=1/($result[$key][$valrmh['id']]['ci']*$sigma[$key]);
                } 
            }
        }
        
        //membagi setiap ofi dengan jumlah faktor objektif
         foreach($rumah as $krmh=>$valrmh){
             $resultFinal[$valrmh['id']]=$resultFinal[$valrmh['id']]/$jmlhObjektif;
         }

        return $resultFinal;

    }

    function subjektifFactorDecisionWeight($subjektif,$subjektifVal,$rumah){
        $result=array();
        $counter=array();

        foreach($subjektif as $key=>$val){
            $counter[$key]=0;
        }

        foreach($subjektif as $key=>$val){
            foreach($rumah as $krmh=>$vrmh){
                $result[$key][$krmh]['total']=0;
                $result[$key][$krmh]['sfdw']=0;
                $result[$key][$krmh]['idRumah']=0;
            }
        }

        //melakukan perhitungan sfdw dengan pairwaise comparison
        foreach($subjektif as $key=> $val){
            foreach($rumah as $krmh=> $vrmh){
                foreach($rumah as $krmh2=> $vrmh2){
                    if($krmh==$krmh2){
                        continue;
                    }
                    if(
                    $key=='garasi'||
                    $key=='carport'||
                    $key=='keamanan'||
                    $key=='halaman'||
                    $key=='petugas_kebersihan'||
                    $key=='dekat_pasar'||
                    $key=='dekat_sekolah'||
                    $key=='dekat_puast_perbelanjaan'||
                    $key=='bebas_banjir'||
                    $key=='dekat_sarana_olahraga'||
                    $key=='daerah_sepi'||
                    $key=='daerah_rindang'||
                    $key=='status_jalan'
                    ){
                        if($vrmh[$key] != null && $vrmh2[$key] == null ){
                            $result[$key][$krmh][$krmh2]=1;
                            $result[$key][$krmh]['total']+=1;
                            $counter[$key]+=1;
                        }
                        else if($vrmh[$key] == null && $vrmh2[$key] != null){
                            $result[$key][$krmh][$krmh2]=0;
                        }
                        else if($vrmh[$key]!=null && $vrmh2[$key] !=null){
                                $result[$key][$krmh][$krmh2]=1;
                                $result[$key][$krmh]['total']+=1;
                                $counter[$key]+=1;
                        }
                        else if($vrmh[$key]==null && $vrmh2[$key]==null){
                            $result[$key][$krmh][$krmh2]=0;
                        }

                      }
                    else if (
                        $key=='sertifikat'||
                        $key=='interior_rumah'||
                        $key=='arah_bangunan'||
                        $key=='bentuk_tanah'||
                        $key=='bentuk_bangunan'
                    ){
                        if($vrmh['id_'.$key]==$subjektifVal[$key.'_val'] && $vrmh2[$key] != $subjektifVal[$key.'_val'] ){
                            $result[$key][$krmh][$krmh2]=1;
                            $result[$key][$krmh]['total']+=1;
                            $counter[$key]+=1;
                         }
                         else if($vrmh['id_'.$key] != $subjektifVal[$key.'_val'] && $vrmh2[$key] == $subjektifVal[$key.'_val']){
                            $result[$key][$krmh][$krmh2]=0;
                        }
                        else if($vrmh['id_'.$key]==$subjektifVal[$key.'_val']  && $vrmh2[$key] ==$subjektifVal[$key.'_val'] ){
                            $result[$key][$krmh][$krmh2]=1;
                            $result[$key][$krmh]['total']+=1;
                            $counter[$key]+=1;
                        }
                        else if($vrmh['id_'.$key]!=$subjektifVal[$key.'_val']  && $vrmh2[$key]!=$subjektifVal[$key.'_val'] ){
                            $result[$key][$krmh][$krmh2]=0;
                        }
                    }
                    else if($key=='jumlah_lantai'){
                        if($subjektifVal[$key.'_val']==1){
                            if($vrmh[$key]==$subjektifVal[$key.'_val'] && $vrmh2[$key] != $subjektifVal[$key.'_val'] ){
                                $result[$key][$krmh][$krmh2]=1;
                                $result[$key][$krmh]['total']+=1;
                                $counter[$key]+=1;
                             }
                             else if($vrmh[$key] != $subjektifVal[$key.'_val'] && $vrmh2[$key] == $subjektifVal[$key.'_val']){
                                $result[$key][$krmh][$krmh2]=0;
                            }
                            else if($vrmh[$key]==$subjektifVal[$key.'_val']  && $vrmh2[$key] ==$subjektifVal[$key.'_val'] ){
                                $result[$key][$krmh][$krmh2]=1;
                                $result[$key][$krmh]['total']+=1;
                                $counter[$key]+=1;
                            }
                            else if($vrmh[$key]!=$subjektifVal[$key.'_val']  && $vrmh2[$key]!=$subjektifVal[$key.'_val'] ){
                                $result[$key][$krmh][$krmh2]=0;
                            }
                        }
                        else if($subjektifVal[$key.'_val']>1){
                            if($vrmh[$key]>=$subjektifVal[$key.'_val'] && $vrmh2[$key]==1 ){
                                $result[$key][$krmh][$krmh2]=1;
                                $result[$key][$krmh]['total']+=1;
                                $counter[$key]+=1;
                             }
                             else if($vrmh[$key] == 1 && $vrmh2[$key] >= $subjektifVal[$key.'_val']){
                                $result[$key][$krmh][$krmh2]=0;
                            }
                            else if($vrmh[$key]>=$subjektifVal[$key.'_val']  && $vrmh2[$key]>=$subjektifVal[$key.'_val'] ){
                                $result[$key][$krmh][$krmh2]=1;
                                $result[$key][$krmh]['total']+=1;
                                $counter[$key]+=1;
                            }
                            else if($vrmh[$key]==1 && $vrmh2[$key]==1 ){
                                $result[$key][$krmh][$krmh2]=0;
                            }
                        }
                        
                        }

                    }
                //idrumah
                $result[$key][$krmh]['idRumah']=$vrmh['id'];
                }
        }

        foreach($subjektif as $key=>$val){
            foreach($rumah as $krmh=>$vrmh){
                if($result[$key][$krmh]['total']==0){
                    $result[$key][$krmh]['sfdw']=0;
                }
                else{
                    $result[$key][$krmh]['sfdw']=$result[$key][$krmh]['total']/$counter[$key];
                }
            }
        }

        return $result;
    }

    function subjektifFactorMeassure($subjektif,$subjektifMatrix,$subjektifDecisionMatrix,$rumah){
        $result=array();
        $resultFinal=array();

        //inisialisasi result
        foreach($subjektif as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                $result[$key][$valrmh['id']]['sfm']=0; 
            }
        }
        //inisialisasi result final
        foreach($rumah as $krmh=>$valrmh){
            $resultFinal[$valrmh['id']]=0; 
        }
        //hitung sfm
        foreach($subjektif as $key=>$val){
            foreach($subjektifDecisionMatrix as $key2=>$val2){
                if($key==$key2){
                   foreach($val2 as $key3=>$val3){
                      $result[$key][$val3['idRumah']]['sfm']=$val3['sfdw']*$subjektifMatrix[$key]['fw'];
                   }
                 }
            }  
        }
        //hitung sfm keseluruhan
        foreach ($result as $key=>$val){
            foreach($rumah as $krmh=>$valrmh){
                $resultFinal[$valrmh['id']]+=$result[$key][$valrmh['id']]['sfm'];
            }
        }

        return $resultFinal;

    }

    function decisionWeight($ofi,$sfm,$rumah,$koef,$prior){
        $result=array();

        //menghitung koef
        $k=$koef/($koef+1);

        //inisialisasi dw untuk setiap rumah
         foreach($rumah as $krmh=>$valrmh){
             $result[$valrmh['id']]=0; 
         }

         //Menghitung Dw
         if($prior==1){
            foreach($rumah as $krmh=>$valrmh){
                $result[$valrmh['id']]=((1-$k)*$ofi[$valrmh['id']])+($k*$sfm[$valrmh['id']]); 
            }
         }
         else{
            foreach($rumah as $krmh=>$valrmh){
                $result[$valrmh['id']]=($k*$ofi[$valrmh['id']])+((1-$k)*$sfm[$valrmh['id']]); 
            }
         }

        return $result;
    }

    function rumahTerbaik($dw){
        arsort($dw);
        $result=array();
        foreach($dw as $key=>$val){
            $hasil=array();
            $hasil[0]=$key;
            $hasil[1]=$val;
            array_push($result,$hasil);
        }
        return $result;
    }
    

}



 





