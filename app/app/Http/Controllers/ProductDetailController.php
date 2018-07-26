<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        $prod = Product::where("identifier", "=", $id)->first();
        return view('product_detail', ["prod" => $prod]);
    }
}
