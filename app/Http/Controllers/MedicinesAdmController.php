<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class MedicinesAdmController extends Controller
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
		$obat = Medicine::all();
        return view('pages.Administrator.Administrator-obat')->with('obat', $obat);
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
			'nama_obat' => 'required',
			'jenis_obat' => 'required',
			'satuan' => 'required',
			'harga_satuan' => 'required'
		]);
		
		// Save data dokter ke MySQL
		$medicine = new Medicine;
		$medicine->nama_obat = $request->input('nama_obat');
		$medicine->jenis_obat = $request->input('jenis_obat');
		$medicine->satuan = $request->input('satuan');
		$medicine->harga_satuan = $request->input('harga_satuan');
		$medicine->save();
		
		return redirect('administrator/obat')->with('success', 'Obat berhasil dibuat');
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
		$medicine = Medicine::find($id);
		return view('pages.Administrator.Administrator-obat-edit')->with('medicine', $medicine);
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
			'nama_obat' => 'required',
			'jenis_obat' => 'required',
			'satuan' => 'required',
			'harga_satuan' => 'required'
		]);
		
		$medicine = Medicine::find($id);
		$medicine->nama_obat = $request->input('nama_obat');
		$medicine->jenis_obat = $request->input('jenis_obat');
		$medicine->satuan = $request->input('satuan');
		$medicine->harga_satuan = $request->input('harga_satuan');
		$medicine->save();
		
		return redirect('administrator/obat')->with('success', 'Obat berhasil ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = Medicine::find($id);
		$medicine->delete();
		
		return redirect('administrator/obat')->with('success', 'Obat berhasil dihapus');
    }
}
