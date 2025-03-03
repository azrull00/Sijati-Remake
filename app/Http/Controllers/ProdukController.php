<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        //ambil semua produk cuy
        $produk = Produk::all();
        return response()->json($produk);
    }

    // nampilkan produk berdasarkan id cuy
    public function show($id)
    {
        // cari produk berdasarkan id cuy
        $produk = Produk::find($id);

        if ($produk) {

            return response()->json($produk);
        }

        return response()->json(['produk gaada cuy'], 404);
    }

    // Nyimpan produk baru cuy
    public function store(Request $request)
    {
        // validasi produk cuy
        $validate = $request->validate([
            'nama_produk' => 'required|string|255',
            'harga' => 'required|integer|100',
            'deskripsi' => 'required|text|255',
            'gambar' => 'required|string',

        ]);

        // nyimpan produk cuy
        $produk = Produk::create($validate);

        return response()->json($produk);
    }

    // Update produk cuy
    public function update(Request $request, $id)
    {

        $produk = Produk::find($id);

        // return massage jika produk ga ada
        if (!$produk) {
            return response()->json(['message' => 'produknya ga ada cuy', 404]);
        }

        // validasi produk cuy
        $validate = $request->validate([
            'nama_produk' => 'required|string|255',
            'harga' => 'required|integer|100',
            'deskripsi' => 'required|text|255',
            'gambar' => 'required|string',
        ]);

        // update data produk
        $produk->update($validate);

        return response()->json($produk);
    }

    // Hapus produk cuy
    public function hapus($id)
    {

        $produk = Produk::find($id);
        $produk->delete();
    }
}
