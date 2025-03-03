<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }


    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(["message" => "datanya gada cuy"], 404);
        }

        return response()->json($customer);
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            "nama" => "required|string",
            "no_telp" => "required",
            "alamat" => "required|string",
            "status" => "required|enum",
        ]);

        $customer = Customer::create($validate);

        return response()->json(["message" => "data berhasil ditambahkan cuy"], 200);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $validate = $request->validate([
            "nama" => "required|string",
            "no_telp" => "required",
            "alamat" => "required|string",
            "status" => "required|enum",
        ]);

        $customer->update($validate);

        return response()->json(["message" => "data berhasil diupdate cuy"], 200);
    }

    public function hapus(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json(["message" => "data berhasil dihapus cuy"], 200);
    }
}
