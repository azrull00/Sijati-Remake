<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    use HasFactory;

    protected $table = 'bom';


    protected $primaryKey = 'id_bom';


    protected $fillable = [
        'id',
        'produk_id',    // kolom yang terkait dengan produk
        'nama',
        'created_at',
        'harga_produksi',
    ];

    public $timestamps = true;

    // Relasi ke tabel produk (foreign key produk_id)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
