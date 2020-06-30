@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
        </div>
        @if(empty($pesanan_detail->id))
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('image') }}/{{ $barang->gambar }}" class="rounded mx-auto d-block" alt="{{ $barang->nama_barang }}" width="100%">
                        </div>
                        <div class="col-md-6 mt-4">
                            <h3>{{ $barang->nama_barang }}</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="30%">Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($barang->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Stok</td>
                                        <td>:</td>
                                        <td>{{ $barang->stok }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $barang->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Jumlah Pesan</td>
                                        <td>:</td>
                                        <td>
                                            <form action="{{ url('pesan') }}/{{ $barang->id }}" method="post">
                                                @csrf
                                                <input type="number" name="jumlah_pesan" class="form-control" required>
                                                <button type="submit" class="btn btn-success mt-2"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                            </form>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @else
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $pesanan_detail->barang->nama_barang }}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('image') }}/{{ $pesanan_detail->barang->gambar }}" class="rounded mx-auto d-block" alt="{{ $pesanan_detail->barang->nama_barang }}" width="100%">
                        </div>
                        <div class="col-md-6 mt-4">
                            <h3>{{ $pesanan_detail->barang->nama_barang }}</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="30%">Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($pesanan_detail->barang->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Stok</td>
                                        <td>:</td>
                                        <td>{{ $pesanan_detail->barang->stok }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $pesanan_detail->barang->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Jumlah Pesan</td>
                                        <td>:</td>
                                        <td>
                                            <form action="{{ url('update') }}/{{ $pesanan_detail->id }}" method="post">
                                                @csrf
                                                <input type="number" name="jumlah_pesan" class="form-control" value="{{ $pesanan_detail->jumlah }}" required>
                                                <button type="submit" class="btn btn-success mt-2"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                            </form>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
    </div>
</div>
@endsection