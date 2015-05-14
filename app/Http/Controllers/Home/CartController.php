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

    public function getClear()
    {
        Session::flush(1,1);

        return response()->json([
            'redirectTo' => '/'
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

            if ($mainPhoto !== null) {
                $product->photo = $mainPhoto->title;
            } else {
                $product->photo = asset('/assets/uploads/no-thumb.png');
            }

            $sum += $product->price * ($quantity[$product->id]);
        }

        return view('cart.index', compact('products', 'sum'));
    }

    public function postDelete()
    {
        $deleteId = Request::input('delete_id');

        $products = Session::get('products');
        $helper = 0;
//        $countProducts = count($products);

        foreach($products as $key =>$product) {

            if ($deleteId == $product) {
                array_splice($products, $helper, 1);
            } else {
                $helper += 1;
            }

        }


        Session::put('products', $products);

        return response()->json([
            'status' => true
        ]);
    }

    public function postChange()
    {
        $products = Session::get('products');

        $targetNumberProducts = Request::input('number');
        $product = Request::input('product_id');
        $helper = 0;
        $numbers = array_count_values($products);

        $numberProduct = $numbers[$product];

        if ($targetNumberProducts == 0) {

            $needle = array_search($product, $products);

            foreach($products as $key => $product) {

                if($needle == $key) {
                    array_splice($products, $key, 1);

                }
            }

            return response()->json([
                'slice' => true
            ]);
        } elseif ($numberProduct < $targetNumberProducts) {
            $n = $targetNumberProducts - $numberProduct;
            for($i = 0; $i < $n; $i++) {
                array_push($products, $product);
            }

        } elseif ($numberProduct > $targetNumberProducts) {
            $n = $numberProduct - $targetNumberProducts;
            for ($i = 0; $i < $n; $i++) {

                $needle = array_search($product, $products);

                foreach($products as $key => $product) {

                    if($needle == $key) {
                        array_splice($products, $key, 1);

                    }
                }

            }
        }


            Session::put('products', $products);
    }





}
