<?php

namespace App\Http\Controllers;

use App\Models\pinjam;
use App\Models\mobil;
use App\Models\logsewa;
use Illuminate\Http\Request;

class pinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function perpanjang(Request $request, $id)
    {
        try {
            $pinjam = pinjam::where('id',$id)->first();
            $tanggalselesai = $pinjam->tanggalselesai;
            
            $ket = $request->ket;
            $jumlah = $request->jumlah;

            if($ket == "perhari") {
                $tanggalselesai = date('Y-m-d H:i:s',strtotime('+'.$jumlah." days",strtotime($tanggalselesai)));
            }else if( $ket == "perjam" ) {
                $tanggalselesai = date('Y-m-d H:i:s',strtotime('+'.$jumlah." hours",strtotime($tanggalselesai)));
            }

            $update = pinjam::where('id',$id)->update([
                'tanggalselesai' => $tanggalselesai
            ]);

            if($update) {
                return redirect('/pengembalian')->with('toast_success','Data berhasil diupdate');
            }

            
        } catch (\Throwable $th) {
            return redirect('/pengembalian')->with('toast_error','terjadi kesalahan');
        }
    }

    public function laporan(Request $request)
    {
        $tampil = logsewa::when($request->keyword, function($query) use ($request){
            $query->where('log_sewa.codemobil','like',"%{$request->keyword}%")
                ->orWhere('mobil.namamobil','like',"%{$request->keyword}%")
                ->orWhere('log_sewa.ktp','like',"%{$request->keyword}%")
                ->orWhere('log_sewa.namapenyewa','like',"%{$request->keyword}%");
        })->join('mobil','mobil.codemobil','=','log_sewa.codemobil')
        ->select('log_sewa.id','log_sewa.codemobil','mobil.namamobil','log_sewa.ktp','log_sewa.namapenyewa','log_sewa.tanggalsewa','log_sewa.tanggalselesai','log_sewa.alamat','log_sewa.hp','log_sewa.ket','log_sewa.sim','log_sewa.tanggalkembali','mobil.hargaperjam','mobil.hargaperhari')
        ->orderBy('log_sewa.id', "DESC")
        ->paginate($request->limit ? $request->limit : 25);

        $tampil->appends($request->only('keyword','limit'));

        return view('pages.laporan',[
            'data' => $tampil
        ]);

    }
    

    public function sewa(Request $request)
    {
        $request->validate([
            'codemobil' => 'required',
            'namapenyewa' => 'required',
            'hp' => 'required',
            'alamat' => 'required',
            'ktp' => 'required',
            'sim' => 'required',
            'ket' => 'required',
            'tanggalsewa' => 'required',
            'jumlah' => 'required',
        ]);


        try {
            $codemobil = $request->codemobil;
            $namapenyewa = $request->namapenyewa;
            $hp = $request->hp;
            $alamat = $request->alamat;
            $ktp = $request->ktp;
            $sim = $request->sim;
            $ket = $request->ket;
            $tanggalsewa = $request->tanggalsewa;
            $jumlah = $request->jumlah;

            $cek = mobil::where('codemobil', $codemobil)->first();

            if ($cek->keterangan != "ada" ) {
                return redirect('/rental')->with('warning','mobil telah dirental');
            }

            if($ket=="perhari") {
                $hari = $jumlah * 24;
                $tanggalselesai = date("Y-m-d H:i:s", strtotime("+".$hari." hours",strtotime($tanggalsewa)));
            }else {
                $tanggalselesai = date("Y-m-d H:i:s", strtotime("+".$jumlah." hours",strtotime($tanggalsewa)));
            }


            $tambah = new pinjam;
            $tambah->codemobil = $codemobil;
            $tambah->namapenyewa = $namapenyewa;
            $tambah->hp = $hp;
            $tambah->alamat = $alamat;
            $tambah->ktp = $ktp;
            $tambah->sim = $sim;
            $tambah->ket = $ket;
            $tambah->tanggalsewa = $tanggalsewa;
            $tambah->tanggalselesai = $tanggalselesai;
            $tambah->save();

            if($tambah) {
                $update = mobil::where("codemobil", $codemobil)->update([
                    'keterangan' => 'tidak'
                ]);
                if($update){
                    return redirect('/rental')->with('success', 'Mobil berhasil di Sewa');
                }
            }
        } catch (\Throwable $th) {
            return redirect('/rental')->with('toast_error', 'terjadi kesalahan');
        }
    }


    public function index(Request $request)
    {
        $tampil = pinjam::when($request->keyword, function($query) use ($request){
            $query->where('pinjam.codemobil','like',"%{$request->keyword}%")
                ->orWhere('mobil.namamobil','like',"%{$request->keyword}%")
                ->orWhere('pinjam.ktp','like',"%{$request->keyword}%")
                ->orWhere('pinjam.namapenyewa','like',"%{$request->keyword}%");
        })->join('mobil','mobil.codemobil','=','pinjam.codemobil')
        ->select('pinjam.id','pinjam.codemobil','mobil.namamobil','pinjam.ktp','pinjam.namapenyewa','pinjam.tanggalsewa','pinjam.tanggalselesai','pinjam.alamat','pinjam.hp','pinjam.ket','pinjam.sim','mobil.hargaperjam','mobil.hargaperhari')
        ->orderBy('pinjam.id', "DESC")
        ->get();


        return view('pages.pengembalian',[
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
    public function destroy(pinjam $data, $id)
    {
        try {
            $tanggalkembali = date("Y-m-d H:i:s");
            $cek = $data->where('id', $id)->first();
            $ktp = $cek->ktp;
            $hapus = $data->destroy($id);
            if($hapus){
                $logcek = logsewa::where('ktp',$ktp)->orderBy('id','DESC')->first();
                $updatelog = logsewa::where('id',$logcek->id)->update([
                    'tanggalkembali' => $tanggalkembali
                ]);
                if ($updatelog) {
                    # code...
                    return redirect('/pengembalian')->with('success','Sewa berhasil diakhiri');
                }

            }
        } catch (\Throwable $th) {
            return redirect('/pengembalian')->with('toast_error','terjadi kesalahan');
            //throw $th;
        }
    }
}
