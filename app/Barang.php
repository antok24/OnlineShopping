<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $fillable = ['nama_barang','gambar','harga','stok','keterangan'];
    
    public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail','barang_id','id');
    }
}
