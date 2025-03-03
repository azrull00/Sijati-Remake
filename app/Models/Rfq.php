<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    use HasFactory;

    protected $table = 'rfq';

    protected $fillable =[
        'vendor_id',
        'nama_produk',
        'harga',
        'created_at',
    ];

    public $timestamps ='true';

    public function vendor(){

        return $this->belongsTo(vendor::class , 'vendor_id' , 'id');

    }

}
