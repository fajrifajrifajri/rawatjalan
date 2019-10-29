<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['frontPageContent','frontPageKontak']]);
    }
    public function frontPageContent() {
		return view('pages.frontPage.frontPage-content');
	}
	public function frontPageKontak() {
		return view('pages.frontPage.frontPage-kontak');
	}
	public function ResepsionisSukses() {
		return view('pages.Resepsionis.Resepsionis-sukses');
	}
	public function ResepsionisAntrian() {
		return view('pages.Resepsionis.Resepsionis-antrian');
	}
	public function AdministratorLaporan() {
		return view('pages.Administrator.Administrator-laporan');
	}
	public function Dashboard() {
		return view('pages.Administrator.Administrator-dashboard');
	}
}
