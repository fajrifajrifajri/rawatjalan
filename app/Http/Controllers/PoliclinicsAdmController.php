<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policlinic;
use Exception;

class PoliclinicsAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
			'nama_poliklinik' => 'required'
		]);
		
		// Save data poliklinik ke MySQL
		$policlinic = new Policlinic;
		$policlinic->nama_poli = $request->input('nama_poliklinik');
		$policlinic->save();
		
		return redirect('administrator/dokter')->with('success', 'Poliklinik berhasil dibuat');
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
		$poli = Policlinic::find($id);
		return view('pages.Administrator.Administrator-poliklinik-edit')->with('poli', $poli);
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
			'nama_poli' => 'required'
		]);
        $policlinic = Policlinic::find($id);
		$policlinic->nama_poli = $request->input('nama_poli');
		$policlinic->save();
		
		return redirect('administrator/dokter')->with('success', 'Poliklinik berhasil ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$poli = Policlinic::findOrFail($id);
		try {
			$poli->delete();
			\Session::flash('success', 'Poliklinik berhasil dihapus');
		} catch (Exception $e) {
			\Session::flash('error', 'Poliklinik sudah terhubung dengan pasien');

		}
		return redirect('administrator/dokter');
    }
}
