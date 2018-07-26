<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class StoreController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        $test_prod = new Product;
        $test_prod->identifier = "25";
        $test_prod->price = 5.0;
        $test_prod->name = "Test";
        $test_prod->img_link = "foo";
        $test_prod->header = "testing";
        $test_prod->description = "Lorum Ipsum";
        $test_prod->category = "50";
        $test_prod->added_field = "OK";
        #$test_prod->save();
        return view('store', ["cats" => $cats]);
    }
}
