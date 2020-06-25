<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $fillable = ['user_id','tanggal','jumlah_harga','status'];
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail','pesanan_id','id');
    }
}
