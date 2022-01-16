@extends('layout.tampilan')

@section('loginActive')
    active
@endsection

@section('title')
    Login
@endsection

@section('content')
    <div class="row align-content-center justify-content-center text-center">
        <div class="col-6">
            <form action="{{ route('login.proses') }}" method="post">
            @csrf
            
            
            <div class="card">
                <div class="card-header">
                    <h3>LOGIN</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">Username</label>
                        <input type="text" name="username" required placeholder="username" class="form-control text-center">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" required placeholder="password" class="form-control text-center">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success px-5">Proses Login</button>
                </div>
                
                
            </div>
            </form>
        </div>
    </div>
@endsection