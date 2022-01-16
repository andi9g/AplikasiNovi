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
        .fontku {
            font-size: 14px
        }

        .kanan {
            float: right;
        }
        .text-kanan {
            text-align: right;
        }

        .clear {
            clear: both;
        }

        .jarakku {
            margin-left: 40px;
        }
        .tableku tr td {
            vertical-align: top;
        }
        .tengah {
            align-content: center;
            justify-content: center;
            text-align: center;
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
                <small><b>Laporan Bukti Rental</b></small>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <br>
                <table class="kanan">
                    <tr>
                        <td>Ket</td>
                        <td>&emsp;:&emsp;</td>
                        <td><b>{{ ucwords($data->ket) }}</b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>&emsp;:&emsp;</td>
                        <td>{{ date("d/m/Y",strtotime($data->tanggalsewa)) }} s/d {{ date("d/m/Y",strtotime($data->tanggalselesai)) }}</td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td>&emsp;:&emsp;</td>
                        <td>{{ date("H:i",strtotime($data->tanggalsewa)) }} s/d {{ date("H:i",strtotime($data->tanggalselesai)) }}</td>
                    </tr>
                </table>

            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                
                <div class="clear"></div>

                <br>


                <table width="100%" class="fontku">
                    <tr valign="top">
                        <td width="50%">
                            <table class="tableku" style="text-transform: capitalize;line-height: 20px">
                                <tr>
                                    <td colspan="15">
                                        <b>IDENTITAS PENYEWA :</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 100px">NIK</td>
                                    <td>: </td>
                                    <td> {{ $data->ktp }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Penyewa</td>
                                    <td>: </td>
                                    <td nowrap style="width: fit-content"> {{ $data->namapenyewa }}</td>
                                </tr>
                                <tr>
                                    <td>No.Hp</td>
                                    <td>: </td>
                                    <td> {{ $data->hp }}</td>
                                </tr>
                                <tr>
                                    <td>SIM</td>
                                    <td>: </td>
                                    <td> {{ $data->sim }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: </td>
                                    <td> {{ $data->alamat }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="tableku" style="text-transform: capitalize;line-height: 20px">
                                <tr>
                                    <td colspan="15">
                                        <b>IDENTITAS MOBIL :</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 100px">Kode Mobil</td>
                                    <td>: </td>
                                    <td> {{ $data->codemobil }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Mobil</td>
                                    <td>: </td>
                                    <td> {{ $data->namamobil }}</td>
                                </tr>
                                <tr>
                                    <td>Warna Mobil</td>
                                    <td>: </td>
                                    <td> {{ $data->warna }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>: </td>
                                    <td> {{ $data->tahun }}</td>
                                </tr>
                                <tr>
                                    <td>Harga Perjam</td>
                                    <td>: </td>
                                    <td> Rp{{ number_format($data->hargaperjam,0,',','.') }}</td>
                                </tr>
            
                                <tr>
                                    <td>Harga Perhari</td>
                                    <td>: </td>
                                    <td> Rp{{ number_format($data->hargaperhari,0,",",".")}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                

            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <br><br>
                <table class="tengah" width="100%">
                    <tr>
                        <td colspan="2">
                            Bintan, {{ date("d F Y") }}
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>TTD Penyewa</td>
                        <td>TTD Pemilik/Admin</td>
                    </tr>
                    <tr>
                        <td><br><br></td>
                        <td><br><br></td>
                    </tr>
                    <tr>
                        <td>{{ $data->namapenyewa }}</td>
                        <td>Pemilik</td>
                    </tr>
                </table>


                
            </td>
        </tr>

    </table>

    

    

    




</body>
</html>