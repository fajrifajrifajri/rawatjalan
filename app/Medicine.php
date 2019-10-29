<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function pasien()
    {
        return $this->belongsToMany('App\Patient', 'patients_medicines_connection', 'id_pasien', 'id_obat'); // Many-to-many koneksi tabel
    }
}
