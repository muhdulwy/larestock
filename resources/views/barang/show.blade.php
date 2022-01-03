@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Show Barang</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('barang.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Barang:</strong>
                {{ $barang->nama }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status Stock:</strong>
                {{ $barang->status }}
            </div>
        </div>
        <div class="form-group">
            <strong>Status Stock:</strong>
            {{ $barang->jumlah }}
        </div>
    </div>
    </div>
@endsection