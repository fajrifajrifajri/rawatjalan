<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Policlinic;
// use Carbon; <- Untuk waktu

class PatientsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	 public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		$data = array();
		$data['pasien'] = Patient::all();
		$data['poliklinik'] = Policlinic::all();
		
        return view('pages.Resepsionis.Resepsionis-input')->with('data', $data);
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
        $this->validate($request, [
			'nama_pasien' => 'required',
			'kelamin' => 'required',
			'tanggal_lahir' => 'required',
			'alamat' => 'required',
			'poliklinik' => 'required'
		]);
		
		// Create Post
		$patient = new Patient;
		$nama_pasien = $request->input('nama_pasien');
		$nama_pasien_exploded = explode(" ", $nama_pasien);
		$nama_pasien_kapital_depan = "";
		foreach($nama_pasien_exploded as $val) {
			$nama_pasien_kapital_depan .= ucfirst($val)." ";
		}
		$patient->nama_pasien = $nama_pasien_kapital_depan;
		$patient->kelamin = $request->input('kelamin');
		$patient->tanggal_lahir = $request->input('tanggal_lahir');
		$patient->alamat = $request->input('alamat');
		$rekamMedis = $request->input('rekam_medis'); // Kosong(pasien baru) atau terisi(pasien sudah pernah berobat);
		if($rekamMedis == null) { // Pasien baru;
			$patient->rekam_medis = $this->getRekamMedis();
		} else { // Pasien lama;
			$patient->rekam_medis = $rekamMedis;
		}
		$patient->id_poliklinik = $request->input('poliklinik');
		$patient->save();
		
		$data = array();
		$data['name'] = $nama_pasien_kapital_depan;
		$data['rm'] = $patient->rekam_medis;
		
		/* 
		$time = Carbon\Carbon::now();
		$timeExplode = explode(" ", $time);
		$data['time'] = $timeExplode[1];
		*/
		
		return view('Pages.Resepsionis.Resepsionis-sukses', compact('data'));
    }
	
	public function getRekamMedis(){
         do{
             $rand = "RM".$this->generateRandomRM(4);
          }while(!empty(Patient::where('rekam_medis',$rand)->first()));
           return $rand;
        }


	public function generateRandomRM($length) {
		$karakter = '0123456789';
		$panjangKarakter = strlen($karakter); // 10
		$randomString = ''; // str kosong
		for ($i = 0; $i < $length; $i++) { // diulang sebanyak 4
			$randomString .= $karakter[rand(0, $panjangKarakter - 1)]; // cth: $randomString = 526178
		}
		return $randomString;
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
}
