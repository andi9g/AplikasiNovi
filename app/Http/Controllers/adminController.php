<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Hash;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tampil = admin::get();

        return view('pages.admin',[
            'data' => $tampil
        ]);
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $username = $request->username;
            $nama = $request->nama;
            $password = Hash::make($request->password);

            $tambah = new admin;
            $tambah->nama = $nama;
            $tambah->username = $username;
            $tambah->password = $password;
            $tambah->save();

            if($tambah) {
                return redirect('/admin')->with('toast_success','Data berhasil ditambah');
            }

        } catch (\Throwable $th) {
           return redirect('/admin')->with('toast_error','Terjadi kesalahan');
        }
        
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
    public function update(Request $request, $id)
    {
        try {
            $username = $request->username;
            $nama = $request->nama;
            if(empty($request->password)){
                $cek = admin::where('id',$id)->first();
                $password = $cek->password;
            }else {
                $password = Hash::make($request->password);
            }

            $update = admin::where('id',$id)->update([
                'nama' => $nama,
                'username' => $username,
                'password' => $password
            ]);

            if ($update) {
                return redirect('/admin')->with('toast_success','Data berhasil ditambah');
            }
            
        } catch (\Throwable $th) {
            return redirect('/admin')->with('toast_error','Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek = admin::count();
            if($cek == 1) {
                return redirect('/admin')->with('toast_error','Minimal memiliki 1 data admin');
            }elseif($cek > 1) {
                $delete = admin::destroy($id);
                if ($delete) {
                    return redirect('/admin')->with('toast_success','Data berhasil di delete');
                }

            }else {
                return redirect('/admin')->with('toast_error','Terjadi kesalahan');
            }
        } catch (\Throwable $th) {
            return redirect('/admin')->with('toast_error','Terjadi kesalahan');
        }
    }

    public function reset($id)
    {
        try {
            $password = Hash::make('admin123');
            $reset = admin::where('id',$id)->update([
                'password' => $password
            ]);
            if ($reset) {
                return redirect('/admin')->with('toast_success','Data berhasil di delete');
            }
        } catch (\Throwable $th) {
            return redirect('/admin')->with('toast_error','Terjadi kesalahan');
        }
    }
}
