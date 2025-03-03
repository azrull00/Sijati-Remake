<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    //Nampilin semua data vendor cuy
    public function index()
    {
        // ngambil data berdasarkan relasi dari tabel cuy
        $vendor = Vendor::with('produk')->get();

        return response()->json($vendor);
    }

    // Nampilin data vendor
    public function show($id)
    {

        $vendor = Vendor::with('produk')->find($id);

        if ($vendor) {
            return response()->json($vendor);
        }

        // return response()->json(['message' => 'Data ga ada cuy'], 404);

        return view('dashboard/manufacturing/manufacturing.vendor', ['vendor' => $vendor]);
    }

    // Nyimpan data vendor cuy
    public function store(Request $request)
    {

        // validasi cuy
        $validate = $request->validate([
            'produk_id' => 'required',
            'nama_vendor' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'created_at' => 'date',
        ]);

        $vendor = Vendor::create($validate);

        return response()->json($vendor);
    }

    // Update data vendor cuy
    public function update(Request $request, $id)
    {

        // cari data vendor berdasarkan relasi dari tabel cuy
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return response()->json(['message' => 'Data tidak ada cuy'], 404);
        }

        // validasi cuy
        $validate = $request->validate([
            'produk_id' => 'required',
            'nama_vendor' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'created_at' => 'date',
        ]);

        $vendor->update($validate);

        return response()->json($vendor);
    }


    public function hapus($id)
    {

        // cari data bom berdasarkan relasi
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json(['message' => 'Data vendor tidak ada cuy'], 404);
        }

        $vendor->delete();
        return response()->json(['message' => 'data berhasil dihapus cuy'], 200);
    }
}
