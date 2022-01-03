@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Stock</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('stock.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stock.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" class="form-control">
                        <option value="">-- Pilih Status --</option>
                            @foreach ($status as $st)
                                <option value="{{ $st }}" {{ old('status', $stock->status) == $st? 'selected' : '' }}>{{ $st}}</option>
                            @endforeach  
                    </select>
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Stock:</strong>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Stock" value="{{ old('jumlah', $stock->jumlah) }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Order</strong>
                    <input type="date" name="tgl_order" class="form-control" placeholder="Tangal Order" value="{{ old('tgl_order', $stock->tgl_order) }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang:</strong>
                    <select name="barang_id" class="form-control">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $br)
                            <option value="{{ $br->id }}" {{ old('barang_id', $stock->barang_id) == $br->id ? 'selected' : '' }}>{{ $br->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
@endsection