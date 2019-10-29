<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class EditUserAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = User::all();
        return view('pages.Administrator.Administrator-dashboard-atur')->with('user', $user);
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
        //
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
       $user = User::find($id);
	   
	   return view('pages.Administrator.Administrator-dashboard-atur-edit')->with('user', $user);
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
            // 'name' => ['required', 'string', 'max:255'], <- di edit ngga perlu edit nama
            'email' => ['required', 'string', 'email', 'max:255'],
			'username' => ['required', 'max:20'],
			'roles' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
		
		// $name = $request->input('name'); <- di edit ngga perlu edit nama
		$username = $request->input('username');
		$roles = $request->input('roles');
		$email = $request->input('email');
		$password = $request->input('password');
		
        User::find($id)
			->update([
            // 'name' => $name, <- di edit ngga perlu edit nama
            'email' => $email,
            'password' => Hash::make($password),
			'username' => $username,
			'roles' => $roles,
        ]);
		
		return redirect('administrator/ubah-user')->with('success', 'User berhasil ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
		$user->delete();
		
		return redirect('administrator/ubah-user')->with('success', 'User berhasil dihapus');
    }
}
