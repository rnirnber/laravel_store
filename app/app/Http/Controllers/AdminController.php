<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class AdminController extends Controller
{
    public function index()
    {
        $prods = Product::all();
        $cats = Category::all();
        return view('admin', ["prods" => $prods, "cats" => $cats]);
    }
    public function update(Request $request)
    {
        $prod = Product::where("identifier", "=", $request->input("identifier"))->first();
        $keys = ["name", "img_link", "header", "description", "price", "category", "added_field"];
        foreach($keys as $key)
        {
            $prod[$key] = ($key === "price" ? floatval($request->input($key)) : $request->input($key));
        }
        $prod->save();
    }
    public function create(Request $request)
    {
        $prod = new Product;
        $keys = ["name", "img_link", "header", "description", "price", "category", "added_field"];
        foreach($keys as $key)
        {
            $prod[$key] = ($key === "price" ? floatval($request->input($key)) : $request->input($key));
        }
        $prod["identifier"] = hash("sha512", strval(time()));
        $prod->save();

    }
    public function delete(Request $request)
    {
        $identifier = $request->input("identifier");
        if($identifier !== null)
        {
            Product::destroy([$identifier]);
        }
    }
}
