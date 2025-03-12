<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard.index");
    }

    public function manufacturing()
    {
        return view("dashboard/manufacturing.manufacturing");
    }

    public function vendor()
    {
        return view("dashboard/manufacturing.vendor");
    }

    public function material()
    {
        return view("dashboard/manufacturing.material");
    }

    public function bom(){

        return view("dashboard/manufacturing.bill_of_materials");
    }

    public function products()
    {
        return view("dashboard.products");
    }

    public function purchasing()
    {
        return view("dashboard.purchasing");
    }

    public function sales()
    {
        return view("dashboard.sales");
    }
}
