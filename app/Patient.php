<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Nama tabel
	// protected $table = 'pasien';
	// Primary Key
	// public $primaryKey = 'idPasien';
	
	protected $fillable = [
        'nama_pasien', 'kelamin', 'tanggal_lahir', 'alamat', 'id_poliklinik'
    ];
	
	public function poliklinik()
    {
        return $this->belongsTo('App\Policlinic', 'id_poliklinik'); // One-to-many koneksi tabel
    }
	
    public function obat()
    {
        return $this->belongsToMany('App\Medicine', 'patients_medicines_connection', 'id_pasien', 'id_obat')->withPivot('jumlah'); // Many-to-many koneksi tabel
    }
	
	 public function resep()
    {
        return $this->belongsToMany('App\DoctorRecipe', 'patients_doctor_recipes_connection', 'id_pasien', 'id_resep')->withPivot('jumlah'); // Many-to-many koneksi tabel
    }
}
