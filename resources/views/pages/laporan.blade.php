@extends('layout.tampilan')

@section('laporanActive')
    active
@endsection

@section('title')
    Laporan Sewa
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


    

  <button type="button" class="btn btn-secondary my-2" data-bs-toggle="modal" data-bs-target="#cetakLaporan">
    <i class="fa fa-print"></i> Cetak Laporan
  </button>

  <!-- Modal -->
<div class="modal fade" id="cetakLaporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('cetak.laporan') }}" method="post" target="_blank">
            @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="">Berdasarkan</label>
                <input type="text" name="berdasarkan" placeholder="2021 / 2021-01 / 2021-01-01" class="form-control">
            </div>

            <div class="form-group">
                <small class="text-success">Ket</small> <br>
                <small class="text-success">Tanggal : 2021-01-01</small> |
                <small class="text-success">Bulan : 2021-01</small> |
                <small class="text-success">Tahun : 2021</small> |
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">CETAK</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    


    <table class="table table-hover table-light table-striped">
        <thead>
            <tr>
            <th scope="col">Nama Penyewa</th>
            <th scope="col">Code Mobil</th>
            <th scope="col">Nama Mobil</th>
            <th scope="col">Tanggal Sewa</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $tampil)
            <tr>
                <td>{{ ucwords($tampil->namapenyewa) }}</td>
                <td>{{ $tampil->codemobil }}</td>
                <td>{{ $tampil->namamobil }}</td>
                <td>{{ date("Y/m/d | H:i:s",strtotime($tampil->tanggalsewa)) }}</td>
                <td>{{ date("Y/m/d | H:i:s",strtotime($tampil->tanggalkembali)) }}</td>
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

                <td>
                    <button type="button" class="btn btn-info py-0 my-0 btn-sm text-bold" data-bs-toggle="modal" data-bs-target="#detail{{ $tampil->id }}">Detail</button>
                    
                </td>
            
            </tr>




           

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



            
                
            @endforeach
            
        </tbody>
    </table> 
     

    <div class="row justify-content-center align-content-center">
        <div class="col-md-12 justify-content-center align-content-center">
            {{ $data->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection