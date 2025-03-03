<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use Illuminate\Http\Request;

class BomController extends Controller
{

    // nampilin semua data bom cuy
    public function index()
    {

        // ngambil data produk berdasarkan relasi dari tabel cuy
        $bom = Bom::with('produk')->get();
        return response()->json($bom);
    }

    // Nampilkan data bom berdasarkan id produk cuy
    public function show($id)
    {
        // ngambil data produk berdasarkan relasi dari tabel cuy
        $bom = Bom::with('produk')->find($id);

        if ($bom) {
            return response()->json($bom);
        }

        return response()->json(['message' => 'data id produk gada cuy'], 404);
    }

    // Nyimpan data bom cuy
    public function store(Request $request)
    {

        // validasi data bom cuy
        $validate = $request->validate([
            'produk_id' => 'required|exist:produk_id',
            'nama' => 'required|string|255',
            'harga_produksi' => 'required|integer|100',
            'created_at' => 'required|date',
        ]);

        $bom = Bom::create($validate);

        return response()->json($bom);
    }

    // Update Data BOM cuy
    public function update(Request $request, $id)
    {
        // cari data produk berdasarkan relasi dari tabel cuy
        $bom = Bom::find($id);
        if (!$bom) {

            return response()->json(['message' => 'BOM tidak ada bang'], 404);
        }

        // validasi data bom cuy
        $validate = $request->validate([

            'produk_id' => 'required|exist:produk_id',
            'nama' => 'required|string|255',
            'harga_produksi' => 'required|integer|100',
            'created_at' => 'required|date',
        ]);

        $bom->update($validate);

        return response()->json($bom);
    }

    // hapus data bom cuy
    public function hapus($id)
    {
        // cari data produk berdasarkan relasi dari tabel cuy
        $bom = Bom::find($id);

        if (!$bom) {
            return response()->json(['message' => 'Data BOM tidak ada'], 404);
        }

        $bom->delete();

        return response()->json(['message' => 'Data berhasil dihapus cuy'], 200);
    }
}
