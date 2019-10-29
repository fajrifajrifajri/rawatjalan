<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Policlinic;
use Exception;

class PatientsAdmController extends Controller
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
		return view('pages.Administrator.Administrator-pasien')->with('data', $data);
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
			'rekam_medis' => 'required',
			'poliklinik' => 'required'
		]);
		
		// Create Patient
		$patient = new Patient;
		$patient->nama_pasien = $request->input('nama_pasien');
		$patient->kelamin = $request->input('kelamin');
		$patient->tanggal_lahir = $request->input('tanggal_lahir');
		$patient->alamat = $request->input('alamat');
		$patient->rekam_medis = $request->input('rekam_medis');
		$patient->id_poliklinik = $request->input('poliklinik');
		$patient->save();
		
		return redirect('administrator/pasien')->with('success', 'Pasien berhasil dibuat');
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
		$data = array();
		
		$data['pasien'] = Patient::join('policlinics', 'patients.id_poliklinik', '=', 'policlinics.id')
					->select(['patients.id', 'patients.id_poliklinik', 'patients.nama_pasien', 'patients.kelamin', 'patients.tanggal_lahir',  'patients.alamat', 'patients.rekam_medis', 'policlinics.nama_poli'])
					->where('patients.id', '=', $id)
					->first();
		$data['poli'] = Policlinic::all();
		
		return view('pages.Administrator.Administrator-pasien-edit')->with('data', $data);
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
		$this->validate($request, [
		  	'nama_pasien' => 'required',
			'kelamin' => 'required',
			'tanggal_lahir' => 'required',
			'alamat' => 'required',
			'poliklinik' => 'required'
        ]);
		
		$nama_pasien = $request->input('nama_pasien');
		$kelamin = $request->input('kelamin');
		$tanggal_lahir = $request->input('tanggal_lahir');
		$alamat = $request->input('alamat');
		$poliklinik = $request->input('poliklinik');
		
        Patient::find($id)
			->update([
            'nama_pasien' => $nama_pasien,
            'kelamin' => $kelamin,
			'tanggal_lahir' => $tanggal_lahir,
			'alamat' => $alamat,
			'id_poliklinik' => $poliklinik
        ]);
		
		return redirect('administrator/pasien')->with('success', 'Pasien berhasil ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$patient = Patient::findOrFail($id);
		try {
			$patient->delete();
			\Session::flash('success', 'Pasien berhasil dihapus');
		} catch (Exception $e) {
			\Session::flash('error', 'Pasien sudah berobat!');
		}
		return redirect('administrator/pasien');
    }
}
