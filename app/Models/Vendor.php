<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;

    protected $table = 'vendor';

    protected $fillable =[
    'id',
    'produk_id',
    'nama',
    'alamat',
    'no_telp',
    ];

    public $timestamps = 'true';

  public function produk(){

    return $this-> belongsTo(produk::class , 'produk_id' , 'id');

  }
}

