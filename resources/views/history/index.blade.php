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
                  <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                </ol>
            </nav>
        </div>
       <div class="col-md-12">
           <div class="card">
               <div class="card-body">
                   <h3><i class="fa fa-history"></i> Riwayat Pemesanan</h3>
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jumlah Harga</th>
                            <th>Detail</th>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pesanan->tanggal  }}</td>
                                    <td>
                                        @if($pesanan->status_bayar == 1)
                                        Sudah di Bayar
                                        @else
                                        Belum dibayar
                                        @endif
                                    </td>
                                    <td align="left">Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode_unik) }}</td>
                                    <td>
                                        <a href="{{ url('history') }}/{{ $pesanan->id }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Pemesanan"><i class="fa fa-info"></i> Detail pemesanan</a>
                                    </td>
                                </tr>
                            @endforeach                           
                        </tbody>
                    </table>
               </div>
           </div>
       </div>
    </div>
</div>
@endsection