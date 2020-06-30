@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ url('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                  <li class="breadcrumb-item active"  aria-current="page"><a href="{{ url('history') }}">History</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>
        @if($pesanan->status_bayar == 1)
        <div class="col-md-12">
           <div class="card">
               <div class="card-body">
                   <h3><i class="fa fa-shopping-cart"></i> Hai {{ Auth::user()->name }}, Berikut Detail Belanjaanmu</h3>
                   <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pesanan_details as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <img src="{{ url('image') }}/{{ $item->barang->gambar }}" width="50">
                                    </td>
                                    <td>{{ $item->barang->nama_barang  }}</td>
                                    <td>{{ $item->jumlah }} item</td>
                                    <td align="left">Rp. {{ number_format($item->barang->harga) }}</td>
                                    <td align="left">Rp. {{ number_format($item->jumlah_harga+$pesanan->kode_unik) }}</td>
                                    <td>
                                        @if($pesanan->status_bayar == 1)
                                        Sudah di Bayar
                                        @else
                                        Belum dibayar
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="7" align="right"></td>
                                <tr>
                        </tbody>
                    </table>
                    <div class="alert alert-success" role="alert">
                        Terima kasih telah belanja di toko online kami, semoga Anda puas dengan pelayanan yang kami berikan.
                    </div>
               </div>
           </div>
        </div>
        @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Hai {{ Auth::user()->name }}, Berikut Detail Belanjaanmu</h3>
                    <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                     <table class="table">
                         <thead>
                             <th>No</th>
                             <th>Gambar</th>
                             <th>Nama Barang</th>
                             <th>Jumlah</th>
                             <th>Harga</th>
                             <th>Total Harga</th>
                         </thead>
                         <tbody>
                             <?php $no = 1; ?>
                             @foreach ($pesanan_details as $item)
                                 <tr>
                                     <td>{{ $no++ }}</td>
                                     <td>
                                         <img src="{{ url('image') }}/{{ $item->barang->gambar }}" width="50">
                                     </td>
                                     <td>{{ $item->barang->nama_barang  }}</td>
                                     <td>{{ $item->jumlah }} item</td>
                                     <td align="left">Rp. {{ number_format($item->barang->harga) }}</td>
                                     <td align="left">Rp. {{ number_format($item->jumlah_harga) }}</td>
                                 </tr>
                             @endforeach
                                 <tr>
                                     <td colspan="5" align="right"><strong> Total Harga</strong></td>
                                     <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                 <tr>
                                 <tr>
                                     <td colspan="5" align="right"><strong> Kode Unik</strong></td>
                                     <td><strong>Rp. {{ number_format($pesanan->kode_unik) }}</strong></td>
                                 </tr>
                                 <tr>
                                     <td colspan="5" align="right"><strong> Total Yang Harus diBayar</strong></td>
                                     <td><strong>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode_unik) }}</strong></td>
                                 </tr>
                                 <tr>
                                     <td colspan="5"></td>
                                     <td>
                                        <a href="{{ url('bayar') }}/{{ $pesanan->id }}" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Bayar Sekarang</a>
                                     </td>
                                 </tr>
                         </tbody>
                     </table>
                </div>
            </div>
         </div>
         @endif
    </div>
</div>
@endsection