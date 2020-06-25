<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $table = 'pesanan_details';
    protected $fillable = ['barang_id','pesanan_id','jumlah','jumlah_harga'];
    
    public function barang()
    {
        return $this->belongsTo('App\Barang','barang_id','id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan','pesanan_id','id');
    }
}
