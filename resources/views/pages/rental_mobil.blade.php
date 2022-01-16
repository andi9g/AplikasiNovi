@extends('layout.tampilan')

@section('rentalActive')
    active
@endsection

@section('title')
    Rental Mobil
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

    <div class="row justify-content-center">
      
      @php
           $i = 0;
      @endphp
      @foreach ($data as $tampil )

      

        <div class="col-12 col-md-6 col-lg-3 mb-4 ">
          <div class="card">
              <img src="{{ url('/gambar/'.$tampil->gambar, []) }}" class="card-img-top gambarku" alt="...">
              <div class="card-body">
                <h5 class="card-title"><b>{{$tampil->namamobil}}</b></h5>
                <p class="card-text">
                  {{$tampil->codemobil}} - 
                  {{ucfirst($tampil->warna)}} -
                  {{$tampil->tahun}}
                </p>
                <p class="card-text mb-0 pb-0">
                  Harga perjam : Rp. {{number_format($tampil->hargaperjam,0,'','.')}}
                </p>
                <p class="card-text my-0 py-0">
                  Harga perhari : Rp. {{number_format($tampil->hargaperhari,0,'','.')}}
                </p>

                <p class="card-text" style="font-weight: bold">
                  KET : 
                  @if ($tampil->keterangan=="ada")
                    <font class="text-success">TERSEDIA</font>
                  @else
                    <font class="text-danger">TIDAK TERSEDIA</font>
                  @endif
                  
                </p>
                
                @if (Session::get('login')==true && $tampil->keterangan == 'ada')
                    

                <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tampilFormMenyewa{{$tampil->id}}">
                  Menyewa
                </button>
                @endif
                
               

              </div>
            </div>

            @if (Session::get('login')==true && $tampil->keterangan == 'ada')
            <!-- Modal -->
            <div class="modal fade" id="tampilFormMenyewa{{$tampil->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data {{ $tampil->namamobil }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('sewa.mobil') }}" method="post">
                    @csrf
                    @method("PATCH")
                  <div class="modal-body">
                   
                    <div class="container">
                      <!-- Content here -->
                      <div class="row mb-3">
                        <label for="tanggal" class="col-sm-4 col-form-label">Tgl Sewa</label>
                        <div class="col-sm-8">
                          <input type="text" name="tanggalsewa" class="form-control disable" id="tanggal" placeholder="col-form-label" value="{{date('Y-m-d H:i:s')}}" readonly>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="typemobil" class="col-sm-4 col-form-label">Type Mobil</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" readonly id="typemobil" value="{{$tampil->namamobil}}" placeholder="Type Mobil"  >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="nopolisi" class="col-sm-4 col-form-label">No.Polisi</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" readonly name="codemobil" id="nopolisi" value="{{$tampil->codemobil}}" placeholder="No Polisi"  >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="warnamobil" class="col-sm-4 col-form-label">Warna Mobil</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" readonly id="warnamobil" value="{{$tampil->warna}}" placeholder="Warna" >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="perjamfor" class="col-sm-4 col-form-label">Perjam Rp</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" readonly value="{{$tampil->hargaperjam}}" id="hargaperjam{{ $i }}" >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="perharifor" class="col-sm-4 col-form-label">Perhari Rp</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" readonly value="{{$tampil->hargaperhari}}" id="hargaperhari{{ $i }}" >
                        </div>
                      </div>

                      <hr>

                      <div class="row mb-3">
                        <label for="namapenyewa" class="col-sm-4 col-form-label">Nama Penyewa</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control text-capitalize" name="namapenyewa" id="namapenyewa" required placeholder="Nama Lengkap"  >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="nohp" class="col-sm-4 col-form-label">No.HP</label>
                        <div class="col-sm-8">
                          <input type="text" required class="form-control" name="hp" id="nohp" placeholder="No.Hp"  >
                        </div>
                      </div>
                      
                      <div class="row mb-3">
                        <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                          <input type="text" required class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap"  >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="noktp" class="col-sm-4 col-form-label">No.KTP</label>
                        <div class="col-sm-8">
                          <input type="number" required class="form-control" name="ktp" id="noktp" placeholder="No.KTP"  >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="nosim" class="col-sm-4 col-form-label">No.SIM</label>
                        <div class="col-sm-8">
                          <input type="number" required class="form-control" name="sim" id="nosim" placeholder="No.SIM"  >
                        </div>
                      </div>
                      
                     

                      <div class="row mb-3">
                        <label for="tanggalpinjam" class="col-sm-4 col-form-label">Lama Pinjam</label>
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

                    


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            @endif
            

            
      </div>
      @php
                       
      $i++;  
    @endphp
      @endforeach
            


      @if ($hitung == 0)
                
            <div class="col-12 col-md-6 col-lg-3 mb-4 text-success">
              Data tidak ditemukan
            </div>
            @endif

    </div>

    
@endsection



@section('jquery')

@endsection
