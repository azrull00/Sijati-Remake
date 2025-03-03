<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{

    public function index()
    {
        $purchaseOrder = PurchaseOrder::all();
        return response()->json($purchaseOrder);
    }


    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::with('rfq')->get();
        return response()->json($purchaseOrder);
    }

    public function store(Request $request)
    {
        // Ngambil data cuy
        $validate = $request->validate([
            'rfq_id' => 'required',
            'nama' => 'required|string|255',
            'harga_total' => 'required|integer|100',
            'created_at' => 'requiered|date',
        ]);

        $purchaseOrder = PurchaseOrder::create($validate);

        return response()->json($purchaseOrder);
    }

    public function update(Request $request, $id)
    {

        $purchaseOrder = PurchaseOrder::find($id);

        if (!$purchaseOrder) {

            return response()->json(['message' => 'datanya gaada cuy '], 404);
        }
        // Ngambil data cuy
        $validate = $request->validate([
            'rfq_id' => 'required',
            'nama' => 'required|string|255',
            'harga_total' => 'required|integer|100',
            'created_at' => 'requiered|date',
        ]);


        $purchaseOrder->update($validate);
        return response()->json($purchaseOrder);
    }

    public function hapus ($id){

        $purchaseOrder = PurchaseOrder::find($id);

        if(!$purchaseOrder){

            return response()->json(['message'=> 'datanya gaada cuy'],404);
        }

        $purchaseOrder->delete();

        return response()->json(['message'=> 'data berhasil dihapus cuy'],200);
    }

}


