<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProdukController extends Controller
{
    public function index()
    {
        try {
            $produk = Produk::all();
            return response()->json($produk);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengambil data'], 500);
        }
    }

    public function show($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return response()->json($produk);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_produk' => 'required|string|max:255',
                'harga' => 'required|numeric|min:100',
                'deskripsi' => 'required|string|max:255',
            ]);

            $produk = Produk::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'data' => $produk
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $produk = Produk::findOrFail($id);

            $validated = $request->validate([
                'nama_produk' => 'required|string|max:255',
                'harga' => 'required|integer|min:100',
                'deskripsi' => 'required|string|max:255',
            ]);

            $produk->update($validated);

            return response()->json([
                'message' => 'Produk berhasil diperbarui',
                'data' => $produk
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function hapus($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();

            return response()->json(['message' => 'Produk berhasil dihapus']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus produk',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
