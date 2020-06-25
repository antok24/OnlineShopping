@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
            </nav>
        </div>
       <div class="col-md-12">
           <div class="card">
               <div class="card-body">
                   <h3><i class="fa fa-shopping-cart"></i> Hai {{ Auth::user()->name }}, Ini Keranjang Belanjamu</h3>
                   <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Opsi</th>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pesanan_detail as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->barang->nama_barang  }}</td>
                                    <td>{{ $item->jumlah }} item</td>
                                    <td align="left">Rp. {{ number_format($item->barang->harga) }}</td>
                                    <td align="left">Rp. {{ number_format($item->jumlah_harga) }}</td>
                                    <td>
                                        <form action="{{ url('check-out') }}/{{ $item->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="center"><strong> Total Harga</strong></td>
                                <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                <td>
                                    <a href="{{ url('konfirmasi-check-out') }}" class="btn btn-success btn-sm"><i class="fa fa-shopping-cart"></i> Check Out</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </div>
           </div>
       </div>
    </div>
</div>
@endsection