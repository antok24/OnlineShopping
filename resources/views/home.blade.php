@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Barang Elektronik Terbaru</h1>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach ($barangs as $barang)
                <div class="col-sm-4 mt-4"> 
                    <div class="card">
                        <img class="card-img-top" alt="" src="{{ url('image') }}/{{ $barang->gambar }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $barang->nama_barang }}</h4>
                            <p class="card-text">
                                <strong>Harga : </strong>Rp.{{ number_format($barang->harga) }} <br>
                                <strong>Stok : </strong> {{ $barang->stok }} <br>
                                <hr>
                                <strong>Keterangan : </strong><br>
                                {{ $barang->keterangan }}
                                <br>
                                <a href="{{ url('pesan') }}/{{ $barang->id }}" class="btn btn-sm btn-primary mt-4"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $barangs->links() }}
        </div>
    </div>
</div>
@endsection
