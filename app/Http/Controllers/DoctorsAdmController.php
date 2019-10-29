<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Policlinic;
use Intervention\Image\Facades\Image;
use Exception;
use Illuminate\Support\Facades\Storage;

class DoctorsAdmController extends Controller
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
		$poliklinik = Policlinic::all();
        return view('pages.Administrator.Administrator-dokter')->with('poliklinik', $poliklinik);
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
			'nama_dokter' => 'required',
			'poli' => 'required',
			'foto' => 'sometimes|file|image|max:10000',
			'alamat' => 'required',
			'telp' => 'required'
		]);
		
		// Save data dokter ke MySQL
		$doctor = new Doctor;
		$doctor->nama_dokter = $request->input('nama_dokter');
		$doctor->id_poliklinik = $request->input('poli');
		$doctor->foto = $request->file('foto');
		$doctor->alamat = $request->input('alamat');
		$doctor->telp = $request->input('telp');
		$doctor->save();
		
		// Menggunakan storeImage() setelah $doctor->save() kalau tidak, akan ada eror 'Image source not readable'
		$this->storeImage($doctor);

		return redirect('administrator/dokter')->with('success', 'Dokter berhasil dibuat');
    }
	
	private function storeImage($doctor) { 
		if (request()->has('foto')) {
			$doctor->update([ 
				// Save gambar dokter ke storage/app/public yang lalu di symlink kan oleh php artisan storage:link ke public_directory
				'foto' => request()->foto->store('uploads', 'public'), 
			]);
			// Resize gambar(fit) menggunakan Image intervention menjadi 200, 200
			$foto = Image::make(public_path('storage/' . $doctor->foto))->fit(200, 200);
			$foto->save();
		}
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
		$data['dokter'] = Doctor::join('policlinics', 'doctors.id_poliklinik', '=', 'policlinics.id')
					->where('doctors.id', '=', $id)
					->select('doctors.*', 'policlinics.nama_poli')
					->first();
		$data['poli'] = Policlinic::all();
		return view('pages.Administrator.Administrator-dokter-edit')->with('data', $data);
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
			'nama_dokter' => 'required',
			'poli' => 'required',
			'foto' => 'sometimes|file|image|max:10000', 
			'alamat' => 'required',
			'telp' => 'required'
		]);
		
		$doctor = Doctor::find($id);
		$doctor->nama_dokter = $request->input('nama_dokter');
		$doctor->id_poliklinik = $request->input('poli');
		if (request()->has('foto')) {
			$doctor->foto = $request->input('foto');
		}		
		$doctor->alamat = $request->input('alamat');
		$doctor->telp = $request->input('telp');
		$doctor->save();
		
		$this->storeImage($doctor);
		
		return redirect('administrator/dokter')->with('success', 'Dokter berhasil ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
		try {
			if($doctor->foto) { // Jika ada foto
				$pathName = storage_path('app/public/' . $doctor->foto);
				// Perlu di unlink() agar ter reset url Storage::delete() supaya hanya $pathName yang menentukan lokasi filenya
				Storage::delete(unlink($pathName));
			}
			$doctor->delete();
			\Session::flash('success', 'Dokter berhasil dihapus');
		} catch (Exception $e) {
			\Session::flash('error', 'Dokter sudah terhubung dengan pasien');
		}
		return redirect('administrator/dokter');
    }
}
