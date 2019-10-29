<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
// Import models //
use App\Patient;
use App\Doctor; 
use App\Policlinic; 
use App\Medicine; 
use App\DoctorRecipe;
use Carbon; 

class APIController extends Controller
{
    public function getAntrian() { // API Controller Antrian & Pasien
		$query = Patient::join('policlinics','patients.id_poliklinik', '=', 'policlinics.id') ->select('patients.id','patients.nama_pasien', 'patients.kelamin', 'patients.tanggal_lahir', 'patients.alamat', 'patients.rekam_medis', 'patients.created_at', 'policlinics.nama_poli');
		return datatables($query)->make(true);
	}
	public function getAntrianRealAntrian() { // API Controller Antrian & Pasien
		$hari = Carbon\Carbon::today();
		$query = Patient::join('policlinics','patients.id_poliklinik', '=', 'policlinics.id') ->select('patients.id','patients.nama_pasien', 'patients.kelamin', 'patients.tanggal_lahir', 'patients.alamat', 'patients.rekam_medis', 'patients.created_at', 'policlinics.nama_poli')->whereDate('patients.created_at', $hari)->get();
		return datatables($query)->make(true);
	}
	public function getDokter() { // API Controller Dokter
		$query = Doctor::join('policlinics','doctors.id_poliklinik', '=', 'policlinics.id') ->select(['doctors.id', 'doctors.nama_dokter', 'doctors.foto','doctors.alamat', 'doctors.telp', 'policlinics.nama_poli']);
		return datatables($query)->make(true);
	}
	public function getPoliklinik() { // API Controller Poliklinik
		$query = Policlinic::select('id', 'nama_poli');
		return datatables($query)->make(true);
	}
	public function getObat() { // API Controller Obat
		$query = Medicine::select('id', 'nama_obat', 'jenis_obat', 'satuan', 'harga_satuan');
		return datatables($query)->make(true);
	}
	public function getResepDokter() { // API Controller Resep
		$query = DoctorRecipe::select('id', 'nama_obat', 'jenis_obat', 'satuan', 'harga_satuan');
		return datatables($query)->make(true);
	}
	public function getPemeriksaan() { // API Controller Pemeriksaan
		$query = Patient::join('policlinics', 'policlinics.id', '=', 'patients.id_poliklinik')
            ->join('doctors', 'doctors.id', '=', 'patients.id_dokter')
            ->select('patients.id', 'patients.rekam_medis', 'patients.nama_pasien', 'patients.id', 'patients.kelamin', 'patients.tanggal_lahir', 'patients.alamat', 'patients.penyakit_atau_gejala', 'patients.keterangan', 'patients.total_harga','patients.bayar',  'patients.created_at', 'patients.updated_at', 'policlinics.nama_poli', 'doctors.nama_dokter')
            ->get();
		return datatables($query)->make(true);
	}
	public function getPembayaranObat() {
		$id = $_POST['id'];
		$pasien = Patient::where("id", $id)->first();
		
		$arr = array();
		foreach($pasien->obat as $obat) { // Foreach untuk relasi many-to-many pasien-obat
			$query = $obat->nama_obat;
			$query2 = $obat->harga_satuan;
			$query3 = $obat->pivot->jumlah;
			
			$arr[] = array('nama_obat' => $query, 'harga_satuan' => $query2, 'jumlah' => $query3);
		}
		
		return json_encode($arr);
	}
	public function getPembayaranResep() {
		$id = $_POST['id'];
		$pasien = Patient::where("id", $id)->first();
		
		$arr = array();
		foreach($pasien->resep as $resep) { // Foreach untuk relasi many-to-many pasien-resep
			$query = $resep->nama_obat;
			$query2 = $resep->harga_satuan;
			$query3 = $resep->pivot->jumlah;
			
			$arr[] = array('nama_obat' => $query, 'harga_satuan' => $query2, 'jumlah' => $query3);
		}

		return json_encode($arr);
	}
	public function getPengunjungBulanan() {
		$query = Patient::selectRaw("DATE_FORMAT(created_at, '%d') tanggal, COUNT(*) pengunjung")->groupBy('tanggal')->where('created_at', '>=', Carbon\Carbon::now()->subMonths(1))->get();
		return datatables($query)->make(true);
	}
	public function getPengunjungTahunan() { 
		$query = Patient::selectRaw("DATE_FORMAT(created_at, '%b') tanggal, COUNT(*) pengunjung")->groupBy('tanggal')->orderByRaw("DATE_FORMAT(created_at, '%m')")->where('created_at', '>=', Carbon\Carbon::now()->subYears(1))->get();
		return datatables($query)->make(true);
	}
	public function getPoliklinikBulanan() { 
		$query = Patient::join('policlinics','patients.id_poliklinik', '=', 'policlinics.id') ->selectRaw("policlinics.nama_poli poli, COUNT(*) pengunjung")->groupBy('poli')->where('patients.created_at', '>=', Carbon\Carbon::now()->subMonths(1))->get();
		return datatables($query)->make(true);
	}
	public function getPoliklinikTahunan() { 
		$query = Patient::join('policlinics','patients.id_poliklinik', '=', 'policlinics.id') ->selectRaw("policlinics.nama_poli poli, COUNT(*) pengunjung")->groupBy('poli')->where('patients.created_at', '>=', Carbon\Carbon::now()->subYears(1))->get();
		return datatables($query)->make(true);
	}
}
