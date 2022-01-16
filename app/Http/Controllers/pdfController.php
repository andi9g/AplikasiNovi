<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\pinjam;
use App\Models\mobil;
use App\Models\logsewa;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function laporan(Request $request)
    {
        
        $berdasarkan = $request->berdasarkan;
        $tampil = logsewa::join('mobil','mobil.codemobil','=','log_sewa.codemobil')
        ->select('log_sewa.id','log_sewa.codemobil','mobil.namamobil','mobil.warna','log_sewa.namapenyewa','log_sewa.hp','log_sewa.alamat','log_sewa.ktp','log_sewa.sim','log_sewa.ket','log_sewa.tanggalsewa','log_sewa.tanggalselesai','mobil.hargaperjam','mobil.hargaperhari','log_sewa.tanggalkembali','mobil.tahun')
        ->where('log_sewa.tanggalkembali','like',"%{$berdasarkan}%")
        ->get();

        $pdf = PDF::loadView('laporan.laporan', [
            'data' => $tampil,
            'berdasarkan' => $berdasarkan
        ]);

        return $pdf->stream();

    }

    public function laporanSewa($id)
    {
        $tampil = pinjam::join('mobil','mobil.codemobil','=','pinjam.codemobil')
        ->select('pinjam.id','pinjam.codemobil','mobil.namamobil','mobil.warna','pinjam.namapenyewa','pinjam.hp','pinjam.alamat','pinjam.ktp','pinjam.sim','pinjam.ket','pinjam.tanggalsewa','pinjam.tanggalselesai','mobil.hargaperjam','mobil.hargaperhari','mobil.tahun')
        ->where('pinjam.id',$id)->first();

        $pdf = PDF::loadView('laporan.sewa', [
            'data' => $tampil
        ]);

        return $pdf->stream();
    }

    

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(pinjam $pinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(pinjam $pinjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pinjam $pinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(pinjam $pinjam)
    {
        //
    }
}
