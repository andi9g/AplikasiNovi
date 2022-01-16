<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Hash;

class prosesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/login');
    }

    public function login(Request $request)
    {
        try {
            $username= $request->username;
            $password= $request->password;

            $cek = admin::where('username', $username)->count();
            if($cek == 1) {
                $data = admin::where('username', $username)->first();
                if(Hash::check($password, $data->password)){
                    $request->session()->put('login', true);
                    $request->session()->put('pemilik', $data->nama);

                    
                    return redirect('/')->with('toast_success','Login berhasil');


                }else {
                    return redirect('/login')->with('warning','Username atau password salah');
                }


            }else {
                return redirect('/login')->with('warning','Username atau password salah');
            }

        } catch (\Throwable $th) {
            return redirect('/login')->with('toast_error','terjadi kesalahan');
        }
    }

    public function index()
    {
        return view('pages.login');
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
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
