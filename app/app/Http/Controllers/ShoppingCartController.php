<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;

class ShoppingCartController extends Controller
{
    public function fetch(Request $request)
    {
        $cart = $request->session()->get("cart");
        if($cart === null)
        {
            $cart = array();
        }
        return response()->json($cart);
    }
    public function add(Request $request, $id)
    {
        $cart = $request->session()->get("cart");
        if($cart === null)
        {
            $cart = array();
        }
        $prod = Product::where("identifier", "=", $id)->first();
        $added_item = ["identifier" => $id, "price" => $prod["price"], "quantity" => 1, "img_link" => $prod["img_link"], "name" => $prod["name"]];
        array_push($cart, $added_item);
        $request->session()->put("cart", $cart);
    }
}
