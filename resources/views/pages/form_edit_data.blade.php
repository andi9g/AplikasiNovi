@extends('layout.tampilan')

@section('homeActive')
    active
@endsection

@section('title')
    edit data
@endsection

@section('content')

<div class="container bg-light m-0 p-4" style="border-radius: 7px;overflow-x: scroll">
    <div class="container">
        <form action="{{ route('data_mobil.update', $mobil->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <h3 class="mb-5">TAMBAH DATA MOBIL</h3>
        <div class="mb-3 row">
            <label for="inputCode" class="col-sm-2 col-form-label">Nomor Polisi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="inputCode" id="inputCode" disabled value="{{ $mobil->codemobil }}" placeholder="Nomor Polisi">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama Mobil</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="inputNama" value="{{ $mobil->namamobil }}" id="inputNama" placeholder="Nama">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputWarna" class="col-sm-2 col-form-label">Warna Mobil</label>
            <div class="col-sm-10">
              <input type="text" class="form-control form-control-sm" name="inputWarna" value="{{ $mobil->warna }}" id="inputWarna" placeholder="Warna">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputTahun" class="col-sm-2 col-form-label">Tahun Mobil</label>
            <div class="col-sm-10">
              <input type="number" class="form-control form-control-sm" name="inputTahun" value="{{ $mobil->tahun }}" id="inputTahun" placeholder="Tahun">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Merek Mobil</label>
            <div class="col-sm-10">
              <select id="js-example-tags" name="inputMerek" class="form-control form-control-sm">
                <option>Ketikan Pilihan</option>
                @foreach ($merekmobil as $item)
                  <option value="{{$item->merekmobil}}" @if ($mobil->merekmobil == $item->merekmobil)
                      selected
                  @endif>{{$item->merekmobil}}</option>
                @endforeach
              </select>
            </div>
          </div>
          

          <script>
            $("#js-example-tags").select2({
              tags: true
            });
          </script>

          <div class="mb-3 row">
            <label for="inputHargaperjam" class="col-sm-2 col-form-label">Harga Perjam Mobil</label>
            <div class="col-sm-10">
              <input type="number" class="form-control form-control-sm" name="inputHargaperjam" value="{{ $mobil->hargaperjam }}" id="inputHargaperjam" placeholder="Harga Per Jam">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputHargaperhari" class="col-sm-2 col-form-label">Harga Perhari Mobil</label>
            <div class="col-sm-10">
              <input type="number" class="form-control form-control-sm" name="inputHargaperhari" value="{{ $mobil->hargaperhari }}" id="inputHargaperhari" placeholder="Harga Per Hari">
            </div>
          </div>

          

          <div class="mb-3 row">
            <label for="inputHargaperhari" class="col-sm-2 col-form-label">Gambar Mobil</label>
            <div class="col-sm-10">
              <input type="file" name="gambarUpload" class="form-control form-control-sm" value="{{ $mobil->gambar }}" id="inputGroupFile02">
            </div>
          </div>

          

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" >reset</button>

            
            
            <button type="submit" class="btn btn-primary">Submit</button>
            
          </div>
          
        </form> 
    </div>
</div>
@endsection