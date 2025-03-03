<?php

namespace App\Http\Controllers;

use App\Models\Rfq;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    public function index()
    {

        $rfq = Rfq::all();

        return response()->json($rfq);
    }


    public function show()
    {

        $rfq = Rfq::with('vendor')->get();
        return response()->json($rfq);
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'vendor_id' => 'required',
            'nama' => 'required|string',
            'harga' => 'required|integer|100',
            'created at' => 'date'
        ]);

        $rfq = Rfq::create($validate);
        return response()->json(['message' => 'data berhasil ditambahkan cuy'], 200);
    }

    public function update(Request $request, $id)
    {
        $rfq = Rfq::find($id);

        if (!$rfq) {

            return response()->json(['message' => 'data gaada cuy']);
        }

        $validate = $request->validate([
            'vendor_id' => 'required',
            'nama' => 'required|string',
            'harga' => 'required|integer|100',
            'created at' => 'date'
        ]);

        $rfq->update($validate);
        return response()->json(['message' => 'data berhasil diupdate cuy'], 200);
    }

    public function hapus($id)
    {

        $rfq = Rfq::find($id);
        $rfq->delete();

        return response()->json(['message' => 'data berhasil dihapus cuy'], 200);
    }
}
