@extends('layout.tampilan')

@section('dataMobilActive')
    active
@endsection

@section('title')
    Data Mobil
@endsection

@section('content')

    <div class="container bg-light m-0 p-4" style="border-radius: 7px;overflow-x: scroll">
        <a href="{{ route("data_mobil.create") }}" class="btn btn-primary my-2">Tambah Data Mobil</a>
        
        <table class="table table-success table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar</th>
                <th scope="col">Code Mobil</th>
                <th scope="col">Nama Mobil</th>
                <th scope="col">warna</th>
                <th scope="col">Tahun</th>
                <th scope="col">Per jam</th>
                <th scope="col">Per Hari</th>
                <th scope="col">ket.</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <img src="{{ url('/gambar/'.$data->gambar, []) }}" width="90px"  alt="">

                    </td>
                    <td>{{ $data->codemobil}}</td>
                    <td>{{ $data->namamobil}}</td>
                    <td>{{ $data->warna}}</td>
                    <td>{{ $data->tahun}}</td>
                    <td>{{ $data->hargaperjam}}</td>
                    <td>{{ $data->hargaperhari}}</td>
                    <td>{{ $data->keterangan}}</td>
                    <td nowrap>
        
                        <a href="{{ route('data_mobil.edit', $data->id) }}" class="btn btn-sm btn-primary d-inline">
                            EDIT
                        </a>
                        <form action="{{ route('data_mobil.destroy', $data->id) }}" method="post" class=" d-inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="mx-2 btn btn-sm btn-danger d-inline" onclick="return confirm('Yakin ingin dihapus?..')">
                                HAPUS
                            </button>
                        
                        </form>
        
                    </td>
                    </tr>
                @endforeach
                
                
            </tbody>
        </table> 

    </div>
     
@endsection