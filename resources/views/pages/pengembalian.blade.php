@extends('layout.tampilan')

@section('pengembalianActive')
    active
@endsection

@section('title')
    Data Mobil
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
      <form action="{{ url()->current() }}" class="d-inline">
      <div class="input-group mb-3">
          <input type="text" class="form-control" name="keyword" value="{{ empty($_GET['keyword'])?'':$_GET['keyword'] }}" placeholder="ketian sesuatu" aria-label="ketian sesuatu" aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit" id="button-addon2"><i class="fa fa-search"></i> Pencarian</button>
        </div>
      </form>
    </div>
  </div>


    


    


    <table class="table table-hover table-light table-striped">
        <thead>
            <tr>
            <th scope="col">Nama Penyewa</th>
            <th scope="col">Code Mobil</th>
            <th scope="col">Nama Mobil</th>
            <th scope="col">Tanggal Sewa</th>
            <th scope="col">Tanggal Selesai</th>
            <th scope="col">Ket</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $tampil)
            <tr>
                <td>{{ ucwords($tampil->namapenyewa) }}</td>
                <td>{{ $tampil->codemobil }}</td>
                <td>{{ $tampil->namamobil }}</td>
                <td>{{ date("d/m/Y | H:i:s",strtotime($tampil->tanggalsewa)) }}</td>
                <td>{{ date("d/m/Y | H:i:s",strtotime($tampil->tanggalselesai)) }}</td>
                <td>
                    @php
                        $awal = strtotime(date("Y-m-d H:i:s", strtotime($tampil->tanggalsewa)));
                        $akhir = strtotime(date("Y-m-d H:i:s",strtotime($tampil->tanggalselesai)));
                        $akhir2 = strtotime(date("Y-m-d H:i:s"));
                        
                        $pinjam = $akhir - $awal;
                        $selesai = $akhir2 - $awal;

                        $jamPinjam =(int) floor($pinjam / (60*60));
                        $jamKembali = (int) floor($selesai / (60*60));
                        $total = $jamKembali - $jamPinjam;
                        $denda = $tampil->hargaperjam * $total
                        
                    @endphp

                    @if ($total < 0)
                    <span class="badge bg-success">Sisa {{ $total * -1 }} Jam</span>
                    @elseif($total == 0)
                    <span class="badge bg-warning">Hari Terakhir</span>
                    @else
                    <span class="badge bg-danger">Telat {{ $total }} Jam</span>
                    @endif

                </td>

                <td>
                    <button type="button" class="btn btn-info py-0 my-0 btn-sm text-bold" data-bs-toggle="modal" data-bs-target="#detail{{ $tampil->id }}"><i class="fa fa-search"></i></button>

                    <form action="{{ route('cetak.laporanSewa', $tampil->id) }}" target="_blank" method="post" class="d-inline">
                        @csrf
                        @method("patch")
                        <button type="submit" class="btn btn-secondary py-0 my-0 mx-1 btn-sm" data-bs-toggle="modal" data-bs-target="#cetakLaporanPengembalian{{ $tampil->id }}"> <i class="fa fa-print"></i> </button>

                    </form>

                    <button type="button" class="btn btn-primary py-0 my-0 btn-sm text-bold" data-bs-toggle="modal" data-bs-target="#perpanjang{{ $tampil->id }}">PERPANJANG</button>
                    

                    <button type="button" class="btn btn-danger py-0 my-0 btn-sm text-bold" data-bs-toggle="modal" data-bs-target="#selesai{{ $tampil->id }}">SELEASI</button>
                </td>
            
            </tr>


            
                    

            </form>

            <!-- Modal -->
            <div class="modal fade" id="perpanjang{{ $tampil->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <form action="{{ route('perpanjang.pengembalian', $tampil->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Perpanjang penyewaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Harga Perjam</label>
                            <div class="col-sm-8">
                              <input type="text" name="" id="hargaperjam{{ $i }}" readonly value="{{ $tampil->hargaperjam }}" class="form-control">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Harga Perhari</label>
                            <div class="col-sm-8">
                              <input type="text" name="" id="hargaperhari{{ $i }}" readonly value="{{ $tampil->hargaperhari }}" class="form-control">
                            </div>
                          </div>
                        

                        <div class="row mb-3">
                            <label for="tanggalpinjam" class="col-sm-4 col-form-label">Lama Perpanjang</label>
                            <div class="col-sm-8">
                              <select onclick="myFunction{{$i}}()" name="ket" id="ket{{ $i }}"class="form-control"  required>
                                <option>-- Pilih --</option>
                                <option value="perjam">Perjam</option>
                                <option value="perhari">Perhari</option>
                              </select>
                            </div>
                          </div>
    
                          <script>
                            function myFunction{{$i}}() {
                              var pilih = document.getElementById('ket{{$i}}').value;
                          
                              if(pilih == "perjam") {
                                document.getElementById('jumlahSewa{{$i}}').style.display='';
                                document.getElementById('masukan{{ $i }}').value="";
                                document.getElementById('total{{ $i }}').innerHTML="";
                          
                              }else if (pilih == "perhari"){
                                document.getElementById('jumlahSewa{{$i}}').style.display='';
                                document.getElementById('masukan{{ $i }}').value="";
                                document.getElementById('total{{ $i }}').innerHTML="";
                          
                              }else {
                                document.getElementById('jumlahSewa{{$i}}').style.display='none';
                                document.getElementById('masukan{{ $i }}').value="";
                                document.getElementById('total{{ $i }}').innerHTML="";
                              }
                            }
                          </script>
                          
                          <div id="jumlahSewa{{$i}}" style="display: none">
                            <div class="row mb-3">
                              <label for="masukkan" class="col-sm-4 col-form-label">Masukan jumlah</label>
                              <div class="col-sm-8">
                                <input type="number" required class="form-control" name="jumlah" id="masukan{{ $i }}" onkeyup="hitung{{ $i }}()" onchange="hitung{{ $i }}()" placeholder="1-10" >
                              </div>
                            </div>
                          </div>

                          <script>
                            function hitung{{ $i }}() {
                                var perjam = document.getElementById('hargaperjam{{ $i }}').value;
                                var perhari = document.getElementById('hargaperhari{{ $i }}').value;
                                
                                var masukan = document.getElementById('masukan{{ $i }}').value;
                                
                                var ket = document.getElementById('ket{{ $i }}').value;
                                if(ket == "perjam") {
                                  var hitung = perjam * masukan;
    
                                  document.getElementById('total{{ $i }}').innerHTML=hitung
                                }else if(ket == "perhari") {
                                  var hitung = masukan * perhari;
                                  document.getElementById('total{{ $i }}').innerHTML=hitung;
                                }else {
                                  document.getElementById('total{{ $i }}').innerHTML="0";
                                }
                            }
    
                          </script>

                        <div class="row align-content-end text-right float-right justify-content-end">
                            <div class="col-md-8 text-right">
                            <h3 class="ml-5">Total Bayar</h3>
                            <h4><font id="total{{ $i }}"></font></h4>

                            </div>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="return confirm('Yakin ingin diupdate!')" class="btn btn-primary">Perpanjang</button>
                    </div>
                </form>
                </div>
                </div>
            </div>




           <!-- Modal -->
            <div class="modal fade" id="selesai{{ $tampil->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <form action="{{ route('pengembalian.destroy', $tampil->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Selesaikan penyewaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    @if ($total > 0)
                        <h2> Telat {{ $total }} Jam</h2>
                        <h3 >Denda <font class="text-danger">Rp{{ number_format($denda,0,',','. ') }}</font></h3>
                    @else
                        <h2>Tersisa {{ $total * -1 }} Jam</h2>
                        <h3 class="text-success"> Tepat waktu</h3>
                    @endif
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="return confirm('Yakin ingin menyelesaikan penyewaan')" class="btn btn-primary">Selesai</button>
                    </div>
                </form>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="detail{{ $tampil->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detail{{ $tampil->id }}" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="detail{{ $tampil->id }}">{{ ucwords($tampil->namapenyewa) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                           
                          <div class="mb-3">
                            <label for="forname" class="form-label">NIK</label>
                            <input type="text" readonly class="form-control" id="forname" value="{{ $tampil->ktp }}">
                          </div>

                          <div class="mb-3">
                            <label for="forname" class="form-label">Alamat</label>
                            <input type="text" readonly class="form-control" id="forname" value="{{ $tampil->alamat }}">
                          </div>

                          <div class="mb-3">
                            <label for="forname" class="form-label">HP</label>
                            <input type="text" readonly class="form-control" id="forname" value="{{ $tampil->hp }}">
                          </div>
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>



            
                {{ $i++ }}
            @endforeach
            
        </tbody>
    </table> 
     
@endsection