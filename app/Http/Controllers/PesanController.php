<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pesanan;
use App\PesananDetail;
use App\User;
use Auth;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addtocart($id)
    {
        $barang = Barang::where('id', $id)->first();
        
        return view('pesan.index', [
            'barang' => $barang
        ]);
    }

    public function pesansekarang(Request $request,$id)
    {
        date_default_timezone_set("Asia/Bangkok");
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //cek stok dulu
        if($request->jumlah_pesan > $barang->stok){
            return redirect('pesan/'.$id);
        }
        //cek validasi id pesanan, jika sudah ada
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(empty($cek_pesanan)){
            //jika pesanan belum mempunyai pesanan_id jalankan ini
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode_unik = mt_rand(100, 999);
            $pesanan->save();
        }

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail)){
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
            
            Alert()->success('Pesanan Berhasil dimasukkan ke keranjang belanja', 'Selamat Yaa..');
        }else{
            $pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();

            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga*$request->jumlah_pesan;

            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();

            Alert()->success('Pesanan Berhasil dimasukkan ke keranjang belanja', 'Oke Pesanan Berhasil ditambahkan');
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesanan->update();

        return redirect('check-out');
    }

    public function check_out()
    {
        $user = User::where('id',Auth::user()->id)->first();

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if($pesanan === null){
            return redirect('home');
        }else{
        $pesanan_detail = PesananDetail::where('pesanan_id',$pesanan->id)->get();
        }

        return view('pesan.check_out', compact('pesanan','pesanan_detail','user'));
    }

    public function deleteone($id)
    {
        $pesanan_detail = PesananDetail::where('id',$id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        Alert()->error('Pesanan Berhasil Hapus dari keranjang belanja anda', 'Oke Pesanan dihapus!!');

        return redirect('check-out');
    }

    public function konfirmasi_check_out()
    {
        $user = User::where('id',Auth::user()->id)->first();
        if(empty($user->alamat)){
            Alert()->error('Oww nampaknya data diri kamu belum lengkap', 'Data Diri Kurang Lengkap');
            return redirect('profile');
        }elseif(empty($user->no_hp)){
            Alert()->error('Oww nampaknya data diri kamu belum lengkap', 'Data Diri Kurang Lengkap');
            return redirect('profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id',$pesanan->id)->get();
        foreach($pesanan_details as $pesanan_detail){
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok-$pesanan_detail->jumlah;
            $barang->update();
        }
        Alert()->success('Pesanan Berhasil dibeli', 'Sukses!!');

        return redirect('history/'.$pesanan_id);
    }

}
