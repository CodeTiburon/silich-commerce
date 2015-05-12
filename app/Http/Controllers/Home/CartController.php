<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Request;
use Illuminate\Support\Facades\Session;
use DB;

class CartController extends Controller {

	public function postAdd()
    {
        $test = DB::table('products')->select(DB::raw('sum(price)'))->whereIn('id', ['158', '160', '161'])->get();

        $productObj = Product::find(Request::input('product_id'));
        $product = $productObj->id;

        if (Session::has('products')) {
            $products = Session::get('products');
        } else {
            $products = [];
        }

        $products[] = $product;
        $countProducts = count($products);
        $sum = DB::table('products')->select(DB::raw('sum(price)'))->whereIn('id', $products)->toArray();
        $pr = $sum[0];
        Session::put('products', $products);


        return response()->json([
           'quantity' => $countProducts,
            'price' => $sum
        ]);

    }

    public function flash()
    {
        Session::flush(1,1);
    }

}
