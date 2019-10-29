<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Memanggil model (Digunakan untuk memanggil tabel dari database) //
use App\Patient; // Model pasien
use App\Policlinic; // Model poliklinik
use App\Doctor; // Model dokter
use App\Medicine; // Modal obat bebas
use App\DoctorRecipe; // Modal resep 
use Carbon;

class DiagnosesController extends Controller
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
		$time = Carbon\Carbon::now();
		$timeExploded = explode(" ", $time);
		$hariIni = $timeExploded[0];
		$data = array();
		$data['pasien'] = Patient::where("created_at", "like", "%".$hariIni. "%")->get();
        $data['poli'] = Policlinic::all();
		$data['dokter'] = Doctor::all();
		$data['obat-bebas'] = Medicine::all();
		$data['resep-dokter'] = DoctorRecipe::all();
		// return Patient::find(1)->obat()->get();
		return view('pages.Administrator.Administrator-pemeriksaan')->with('data', $data);
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
			'poliklinik' => 'required',
			'id_dokter' => 'required',
			'penyakit' => 'required',
			// 'kode_resep' => 'required'
		]);
		
		$id = $request->input('id_pasien');
		
		$patient = Patient::find($id);
		$patient->id_dokter = $request->input('id_dokter');
		$patient->penyakit_atau_gejala = $request->input('penyakit');
		$id_obat = $request->input('id_obat');
		$id_resep = $request->input('id_resep');
		// Ganti isi dari array dari string jadi array (jadinya isinya berubah jadi array) hasilnya: multidimensional array
		foreach($id_obat as $key => $arr)
		{
			$id_obat[$key] = explode(",", $arr);
		}
		foreach($id_resep as $key => $arr)
		{
			$id_resep[$key] = explode(",", $arr);
		}
		// Menjadikan multidimensional array di merge menjadi simple array
		function array_flatten($array) { 
		  if (!is_array($array)) { 
			return FALSE; 
		  } 
		  $result = array(); 
		  foreach ($array as $key => $value) { 
			if (is_array($value)) { 
			  $result = array_merge($result, array_flatten($value)); 
			} 
			else { 
			  $result[$key] = $value; 
			} 
		  } 
		  return $result; 
		} 
		$obat = array_flatten($id_obat);
		// Pisah simple array dibagi menjadi dua: ganjil dan genap. Ganjil: id_pasien Genap: jumlah
		$ganjil = array();
		$genap = array();
		$both = array(&$ganjil, &$genap);
		array_walk($obat, function($v, $k) use ($both) { $both[$k % 2][] = $v; });
		// Tambah object obat 'jumlah' ke setiap genap
		for($i=0 ; $i<count($genap) ; $i++){
			$patient->obat()->attach($ganjil[$i], ['jumlah' => $genap[$i]]);
		}
		/// Resep
		$resep = array_flatten($id_resep);
		// Pisah simple array dibagi menjadi dua: ganjil dan genap. Ganjil: id_pasien Genap: jumlah
		$ganjil = array();
		$genap = array();
		$both = array(&$ganjil, &$genap);
		array_walk($resep, function($v, $k) use ($both) { $both[$k % 2][] = $v; });
		// Tambah object resep 'jumlah' ke setiap genap
		for($i=0 ; $i<count($genap) ; $i++){
			$patient->resep()->attach($ganjil[$i], ['jumlah' => $genap[$i]]);
		}
		$patient->keterangan = $request->input('keterangan');
		$harga_obat = $request->input('harga_obat');
		$harga_tambahan = $request->input('harga_tambahan');
		$patient->total_harga = $harga_obat + $harga_tambahan;
		$patient->periksa = $request->input('periksa');
		$patient->save();
		
		return redirect('administrator/pemeriksaan')->with('success', 'Pemeriksaan berhasil');
		
		/*
		
        $this->validate($request, [
			'nama_pasien' => 'required',
			'poliklinik' => 'required',
			'nama_dokter' => 'required',
			'penyakit' => 'required',
			// 'kode_resep' => 'required'
		]);
		
		// Save data dokter ke MySQL
		
		
		
		
		$diagnose = new Diagnose;
		$diagnose->nama_pasien = $request->input('nama_pasien');
		$diagnose->nama_poliklinik = $request->input('poliklinik');
		$diagnose->nama_dokter = $request->input('nama_dokter');
		$diagnose->penyakit_atau_gejala = $request->input('penyakit');
		$resep_array = $request->input('kode_resep');
		$diagnose->kode_resep = implode(", ", $resep_array);
		$diagnose->keterangan = $request->input('keterangan');
		$id_patient = $request->input('id');
		$patient = Patient::find($id_patient); // Watch out, find($id_patient)
		$patient->periksa = $request->input('periksa');
		$harga_resep = $request->input('harga_resep');
		$harga_tambahan = $request->input('harga_tambahan');
		$total_harga = $harga_resep + $harga_tambahan;
		$diagnose->total_harga = $total_harga;
		$diagnose->save();
		$patient->save();
		*/
		
		return redirect('administrator/pemeriksaan')->with('success', 'Pemeriksaan berhasil');
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
