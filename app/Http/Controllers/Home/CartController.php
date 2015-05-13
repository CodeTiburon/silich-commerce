<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\Photo;

class CartController extends Controller {

	public function postAdd()
    {

        $productObj = Product::find(Request::input('product_id'));
        $product = $productObj->id;

        $sum = 0;
        if (Session::has('products')) {
            $products = Session::get('products');
            $products[] = $product;
            $productsObjects = DB::table('products')->whereIn('id', $products)->get();
            $quantity = array_count_values($products);

            foreach($productsObjects as $productIterator){
                $sum += $productIterator->price * ($quantity[$productIterator->id]);
            }


        } else {
            $products = [];
            $products[] = $product;
            $sum = $productObj->price;
        }
        $countProducts = count($products);
        Session::put('products', $products);


        return response()->json([
           'quantity' => $countProducts,
            'price' => $sum
        ]);

    }

    public function getDisplay()
    {
        $productsArray = Session::get('products');
        $products = DB::table('products')->whereIn('id', $productsArray)->get();
        $quantity = array_count_values($productsArray);
        $sum = 0;

        foreach ($products as $product) {
            $mainPhoto = Photo::find($product->photo_id);
            $productQuantity= $quantity[$product->id];
            $product->quantity = $productQuantity;
            $product->photo = $mainPhoto->title;
            $sum += $product->price * ($quantity[$product->id]);
        }

        return view('cart.index', compact('products', 'sum'));
    }

    public function getClear()
    {
        Session::flush(1,1);

        return response()->json([
            'redirectTo' => '/'
        ]);
    }

}
