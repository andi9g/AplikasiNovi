<?php

namespace App\Http\Controllers;

use App\Models\mobil;
use Illuminate\Http\Request;
Use Alert;

class mobilController extends Controller
{

    public function tampilRental(Request $request)
    {
        
        $sql = mobil::when($request->keyword, function($query) use ($request){
            $query->where('codemobil','like',"%{$request->keyword}%")
                ->orWhere('namamobil','like',"%{$request->keyword}%")
                ->orWhere('keterangan','like',"%{$request->keyword}%");
        })->orderBy('keterangan', "ASC")
        ->paginate($request->limit ? $request->limit : 10);

        $sql->appends($request->only('keyword','limit'));


        $hitung = count($sql);
        return view("pages.rental_mobil", [
            'data' => $sql,
            'hitung' => $hitung
        ]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = mobil::get();
        return view("pages.data_mobil", [
            'data' => $sql
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mobil = mobil::groupBy('merekmobil')->select('merekmobil')->get();
        return view("pages.form_tambah_data",[
            'merekmobil' => $mobil,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            $file = $request->file("gambarUpload");

            
            $size = $file->getSize();
            $ex = $file->getClientOriginalExtension();
            $conv = strtolower($ex);

            $tgl = date('Y-m-d');
            $acak = strtotime($tgl);
            $namaGambar = $acak.".".$ex;

            // dd($request->inputMerek);
            if($conv=="jpeg" || $conv =="jpg" || $conv == "png"){
                if($size <= 3000000){
                    $file->move(\base_path()."/public/gambar", $namaGambar);
                    $tambah = new mobil;
                    $tambah->codemobil = $request->inputCode;
                    $tambah->namamobil = $request->inputNama;
                    $tambah->merekmobil = $request->inputMerek;
                    $tambah->warna = $request->inputWarna;
                    $tambah->tahun = $request->inputTahun;
                    $tambah->hargaperjam = $request->inputHargaperjam;
                    $tambah->hargaperhari = $request->inputHargaperhari;
                    $tambah->gambar = $namaGambar;
                    $tambah->keterangan = "ada";
                    $tambah->save();

                    if($tambah){
                        return redirect("data_mobil")->with("toast_success", "Data berhasil ditambahkan..");
                    }
                }else {
                    return redirect("data_mobil/create")->with('toast_error', 'Ukuran gambar tidak sesuai, min 2Mb!');
                }
            }else {
                return redirect("data_mobil/create")->with('toast_error', 'Extensi duperbolehkan jpeg, jpg dan png!');
            }
            
            
            
           
        } catch (\Throwable $th) {
            //throw $th;
            
            return redirect("data_mobil/create")->with('toast_error', 'Terjadi kesalahan sistem!');
        }
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
    public function edit(mobil $mobil, $id)
    {
        $data = $mobil->where("id", $id)->first();
        $mobil = mobil::groupBy('merekmobil')->select('merekmobil')->get();
       
        return view("pages.form_edit_data",[
            'mobil' => $data,
            'merekmobil' => $mobil,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mobil $mobil, $id)
    {
        try {
            $update_gambar = false;
            $ket = $mobil->where("id", $id)->first();
            
            $update = $mobil->where("id", $id)->update([
                'namamobil' => $request->inputNama,
                'warna' => $request->inputWarna,
                'tahun' => $request->inputTahun,
                'merekmobil' => $request->inputMerek,
                'hargaperjam' => $request->inputHargaperjam,
                'hargaperhari' => $request->inputHargaperhari,
                'keterangan' => $ket->keterangan,
            ]);

            if($request->hasFile('gambarUpload')){
                $file = $request->file("gambarUpload");

            
                $size = $file->getSize();
                $ex = $file->getClientOriginalExtension();
                $conv = strtolower($ex);

                $tgl = date('Y-m-d');
                $acak1 = rand(1000, 9999);
                $acak = strtotime($tgl);

                $namaGambar = $acak."-".$acak1.".".$ex;

                if($conv=="jpeg" || $conv =="jpg" || $conv == "png"){
                    if($size <= 3000000){
                        $file->move(\base_path()."/public/gambar", $namaGambar);
                        $update_gambar = $mobil->where("id",$id)->update([
                            'gambar' => $namaGambar,
                        ]);
                    }
                }
            }
            

            if($update_gambar===true || $update){
                return redirect("data_mobil")->with("toast_success", "Data berhasil diupdate..");
            }



        } catch (\Throwable $th) {
            return redirect("data_mobil")->with("toast_error", "Data gagal diupdate..");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy(mobil $mobil,$id)
    {
        $delete = $mobil->destroy($id);

        if($delete){
            return redirect("data_mobil")->with("toast_success", "Data berhasil dihapus");
        }else {
            return redirect("data_mobil")->with("toast_error", "Data gagal dihapus");
        }
    }
}
