@extends('layout.tampilan')

@section('homeActive')
    active
@endsection

@section('title')
    home
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/data_mobil', []) }}" class="btn btn-primary btn-block my-2 py-3"  style="width: 100%;" >
                Jumlah Mobil <span class="badge bg-secondary">{{ $jmobil }}</span>
            </a>
        </div>
    


        <div class="col-md-6">
            <a href="{{ url('/pengembalian', []) }}" class="btn btn-primary d-block my-2 py-3" style="width: 100%;">
                Jumlah Rental <span class="badge bg-secondary">{{ $jrental }}</span>
            </a>
        </div>



        <div class="col-md-6">
            <a href="{{ url('/rental', []) }}" class="btn btn-success d-block my-2 py-3" style="width: 100%;">
               Mobil Yang Tersedia <span class="badge bg-secondary">{{ $jmobiltersedia }}</span>
            </a>
        </div>


    </div>
@endsection