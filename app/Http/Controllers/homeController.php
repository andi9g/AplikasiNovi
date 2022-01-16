<?php

namespace App\Http\Controllers;

use App\Models\mobil;
use App\Models\pinjam;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jmobil = mobil::count();
        $jmobiltersedia = mobil::where('keterangan','ada')->count();
        $jrental = pinjam::count();


        return view('pages.home',[
            'jmobil' => $jmobil,
            'jmobiltersedia' => $jmobiltersedia,
            'jrental' => $jrental,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show(mobil $mobil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function edit(mobil $mobil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mobil $mobil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy(mobil $mobil)
    {
        //
    }
}
