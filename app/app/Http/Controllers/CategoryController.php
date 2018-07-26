<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;

class CategoryController extends Controller
{
    public function index(Request $request, $id)
    {
        $prods = Product::where("category", "=", $id)->get();
        #$prods = Product::whereIn("identifier", ["2680C4075D5E96183F5FB746D0114D133E4450AFEC627206C98C525EFA6FF8AD9D22B2385793E457514A7EA7CC9482453C9A018EA953795CCECAC72237C4EDF3", "87F772C7B37B8271374C1A2BF1954A6DC24742624BC13B5A9C6BC1CEF82973F67221B1EEF25813E8DBB8C5039FF9E6CBA226A467F01B75D72C9FABEA436F80CA"])->get();
        #$prods = Product::where("identifier", "=", "2680C4075D5E96183F5FB746D0114D133E4450AFEC627206C98C525EFA6FF8AD9D22B2385793E457514A7EA7CC9482453C9A018EA953795CCECAC72237C4EDF3")->orWhere("identifier", "=", "87F772C7B37B8271374C1A2BF1954A6DC24742624BC13B5A9C6BC1CEF82973F67221B1EEF25813E8DBB8C5039FF9E6CBA226A467F01B75D72C9FABEA436F80CA")->get();
        /*$prods = Product::where
        (
            [
                ["category", "=", $id],
                ["category", "!=", "-1"]
            ]
        )->get();*/
        $cat = Category::where("identifier", "=", $id)->first();
        /*$value = $request->session()->get("counter");
        if($value === null)
        {
            $request->session()->put("counter", 1);
            $value = 1;
        }
        else
        {
            $request->session()->put("counter", $request->session()->get("counter") + 1);
        }
        //echo $value;
        return response()->json(["counter" => $value]);*/

        /*$counter = intval($request->cookie("counter"));
        $response = new Response;
        $rendered_html = view('category', ["prods" => $prods, "cat" => $cat]);
        $response->setContent($rendered_html);
        $response->cookie("counter", strval($counter + 1), 5);*/
        #$cook = Cookie::queue("counter", strval($counter + 1), 5);
        #print_r($counter);
        $response = view('category', ["prods" => $prods, "cat" => $cat]);
        return $response;
        //return "foo";
    }
}
