@extends('layout.tampilan')

@section('adminActive')
    active
@endsection

@section('title')
    Data Admin
@endsection

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahAdmin">
    <i class="fa fa-plus-circle"></i> Tambah Admin
  </button>

  <!-- Modal -->
<div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.store', []) }}" method="post">
        @csrf

        
        <div class="modal-body">
            <div class="form-group mb-3">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama" id="nama_lengkap" class="form-control" placeholder="nama lengkap">
            </div>
            <div class="form-group mb-3">
                <label for="username_">Username</label>
                <input type="text" name="username" id="username_" class="form-control" placeholder="username">
            </div>
            <div class="form-group mb-3">
                <label for="password_">password</label>
                <input type="password" name="password" id="password_" class="form-control" placeholder="password">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
      </div>
    </div>
  </div>




    <div class="">
        <table class="table table-striped table-light table-hover">
            <tr>
                <th>Nama Admin</th>
                <th>Username</th>
                <th>password</th>
                <th>aksi</th>
            </tr>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $tampil)
                <tr>
                    <td>{{ $tampil->nama }}</td>
                    <td>{{ $tampil->username }}</td>
                    <td>
                        @if (Hash::check('admin123',$tampil->password))
                            default : admin123
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-info py-0 py-0 btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $tampil->id }}">
                            <i class="fa fa-edit"></i> edit
                        </button>

                        <form action="{{ route('admin.reset', $tampil->id) }}" method="post" class="d-inline mx-2">
                            @csrf
                            <button type="submit" onclick="return confirm('yakin ingin direset')" class="btn btn-warning py-0 py-0 btn-sm">
                                <i class="fa fa-key"></i> reset
                            </button>
                        </form>

                        <form action="{{ route('admin.destroy', $tampil->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('yakin ingin dihapus')" class="btn btn-danger py-0 py-0 btn-sm">
                                <i class="fa fa-trash"></i> edit
                            </button>
                        </form>

                    </td>
                </tr>

                 <!-- Modal -->
                <div class="modal fade" id="edit{{ $tampil->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $tampil->admin }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.update', $tampil->id) }}" method="post">
                    @csrf
                        @method('PUT')
                    
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama_lengkap" class="form-control" placeholder="nama lengkap" value="{{ $tampil->nama }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="username_">Username</label>
                            <input type="text" name="username" readonly id="username_" class="form-control" placeholder="username" value="{{ $tampil->username }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_">password baru</label>
                            <input type="password" name="password" minlength="6" id="password_" class="form-control" placeholder="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
                    </div>
                </div>
                </div>

                @php
                    $i++;
                @endphp
            @endforeach
        </table>
    </div>


@endsection