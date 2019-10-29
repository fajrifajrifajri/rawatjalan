<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DoctorRecipe;

class DoctorRecipeAdmController extends Controller
{
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
			'nama_obat' => 'required',
			'jenis_obat' => 'required',
			'satuan' => 'required',
			'harga_satuan' => 'required'
		]);
		
		// Save data dokter ke MySQL
		$recipe = new DoctorRecipe;
		$recipe->nama_obat = $request->input('nama_obat');
		$recipe->jenis_obat = $request->input('jenis_obat');
		$recipe->satuan = $request->input('satuan');
		$recipe->harga_satuan = $request->input('harga_satuan');
		$recipe->save();
		
		return redirect('administrator/obat')->with('success', 'Resep dokter berhasil dibuat');
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
        $recipe = DoctorRecipe::find($id);
		return view('pages.Administrator.Administrator-resep-edit')->with('recipe', $recipe);
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
		
		$recipe = DoctorRecipe::find($id);
		$recipe->nama_obat = $request->input('nama_obat');
		$recipe->jenis_obat = $request->input('jenis_obat');
		$recipe->satuan = $request->input('satuan');
		$recipe->harga_satuan = $request->input('harga_satuan');
		$recipe->save();
		
		return redirect('administrator/obat')->with('success', 'Resep dokter berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = DoctorRecipe::find($id);
		$recipe->delete();
		
		return redirect('administrator/obat')->with('success', 'Resep berhasil dihapus');
    }
}
