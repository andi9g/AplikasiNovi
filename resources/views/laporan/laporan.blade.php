<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Sewa</title>
    <style type="text/css">
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        h1 {
            margin: 0;
            padding: 0;
        }
        h2 {
            margin: 0;
            padding: 0;
        }
        h4 {
            margin: 0;
            padding: 0;
            font-weight: normal;
        }
        p {
            margin: 0;
            padding: 0;
        }
        hr {
            margin: 2px 0;
            padding: 0;
        
        }

        .kanan {
            float: right;
        }
        .text-kanan {
            text-align: right;
        }
        .fontku {
            font-size: 12px
        }
        .fontku tr td {
            padding: 0 2px;
        }

        .clear {
            clear: both;
        }

        .jarakku {
            margin-left: 40px;
        }
    </style>
</head>
<body>

    <table width="100%">
        <tr valign="top">
            <td style="width: fit-content;padding-right: 10px">
                <img src="{{ url('/logo/Logo.png', []) }}" width="80px" alt="">
            </td>
            <td>
                <h2>YOGI JAYA RENTAL</h2>
                <p>jl. wisata bahari rt.02 rw.02 kel. kawal, kec.gunung kijang</b></p>
                <hr>
                <small><b>Laporan Rental | 
                @php
                    $cek = explode("-",$berdasarkan);
                    $jumlah = count($cek);
                    if($jumlah == 1) {
                        echo $berdasarkan;
                    }elseif($jumlah == 2){
                        echo date('F Y', strtotime($berdasarkan."-01"));
                    }elseif ($jumlah == 3) {
                        echo date('d F Y', strtotime($berdasarkan));
                    }else {
                        echo "all";
                    }
                @endphp
                </b></small>
            </td>
        </tr>   
    </table>

    <br>
    <br>

    <small>Tabel Perentalan</small>
    <table width="100%" rules='all' class="fontku" style="text-transform: capitalize">
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Nama Penyewa</th>
            <th>No Polisi</th>
            <th>Nama Mobil</th>
            <th>Lama Rental</th>
            <th>Denda</th>
            <th>Jml Bayar</th>
            <th>Tgl Kembali </th>
        </tr>
        @php
            $i = 1;
            $totalUntung = 0;
            $totalDenda = 0;
        @endphp
        @foreach ($data as $tampil)
        <tr>
            <td style="width: fit-content">{{ $i }}</td>
            <td style="width: fit-content">{{ $tampil->ktp }}</td>
            <td nowrap style="text-transform: capitalize">{{ $tampil->namapenyewa }}</td>
            <td style="width: fit-content">{{ $tampil->codemobil }}</td>
            <td>{{ $tampil->namamobil }}</td>
            @php
                $awal = strtotime($tampil->tanggalsewa);
                $akhir = strtotime($tampil->tanggalselesai);
                $kembali = strtotime($tampil->tanggalkembali);

                $sewa = $akhir - $awal;

                $denda = $kembali - $awal;

                $lamaSewa = (int) floor($sewa / (60*60));
                
                $lamaKembali = (int) floor($denda / (60*60));
                $hitung = $lamaKembali - $lamaSewa;

                if($hitung > 0) {
                    $telat = "telat ".$hitung." jam";
                    $bayarDenda = $hitung * $tampil->hargaperjam;
                    
                }else {
                    $telat = "Tidak telat";
                    $bayarDenda = "0";
                }

                $perhari = $tampil->hargaperhari;
                $perjam = $tampil->hargaperjam;



            @endphp
            <td style="width: fit-content" nowrap>
                @if ($tampil->ket == "perhari")
                {{ (int) ($lamaSewa / 24) }} Hari {{ (int) ($lamaSewa % 24) }} Jam, {{ $telat }}
                
                @else
                {{ $lamaSewa }} jam, {{ $telat }}

                @endif
            </td>
            <td style="width: fit-content">
                {{ number_format($bayarDenda ,0,",",".") }}
            </td>
            <td>
                @php
                    if($lamaSewa >= 24) {
                        $sisabayar = (int) ($lamaSewa % 24) * $perjam;
                    }else {
                        $sisabayar = 0 * $perjam;
                    }

                    if ($tampil->ket == "perhari") {
                        $harisewa = (int) ($lamaSewa / 24);
                        $jumlahBayar = $harisewa * $perhari + $sisabayar;
                        echo number_format($jumlahBayar ,0,",",".");
                         
                    }else {
                        $jumlahBayar = $lamaSewa * $perjam + $sisabayar;
                        echo number_format($jumlahBayar ,0,",",".");
                    }
                @endphp
            </td>

            <td>
                {{ date("d/m/Y",strtotime($tampil->tanggalkembali)) }}
            </td>

        </tr>
            
        @php
            if($bayarDenda == "-") {
                $bayarDenda = 0;
            }

            $totalDenda = $totalDenda + $bayarDenda; 
            $totalUntung = $totalUntung + $jumlahBayar; 

        @endphp

        {{ $i++ }}
        @endforeach

    </table>

    <br>


    <table class="fontku">
        <tr>
            <td>Total Denda</td>
            <td>:</td>
            <td>Rp{{ number_format($totalDenda,0,",",".") }}</td>
        </tr>
        <tr>
            <td>Total Keuntungan</td>
            <td>:</td>
            <td>Rp{{ number_format($totalUntung,0,",",".") }}</td>
        </tr>


    </table>
    

    

    




</body>
</html>