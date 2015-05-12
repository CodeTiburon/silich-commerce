<?php namespace App\Http\Controllers\Home;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Photo;
use App\Product;
use Request;


class DisplayProductsController extends Controller {

	public function index()
    {
        $categories = Category::all()->toHierarchy();
        return view('home.index', compact('categories'));
    }

    public function postDisplayProducts()
    {
        $category = Category::find(Request::input('category_id'));
        $products = $category->products()->get();

        foreach ($products as $product) {
            $photoId = $product->photo_id;

            $photo = Photo::find($photoId);

            if ($photo == null){
                $product['photo'] = 'http://test1.com/assets/uploads/no-thumb.png';
            } else {
                $product['photo'] = $photo->title;
            }
        }

        return response()->json([
            'products' => $products
        ]);
    }

//    public function postShowProduct()
//    {
//        $id = Request::input('prod_id');
//        return response()->json([
//            'redirectTo' => '/product/show/' . $id
//        ]);
//    }

    public function postShow($id)
    {
        return response()->json([
            'redirectTo' => '/products/show-product/' . $id
        ]);
    }

    public function getShowProduct($id)
    {
        $product = Product::find($id);
        $mainPhoto = Photo::find($product->photo_id);
        $photos = Photo::where('product_id', '=', $id)->get();
        return view('home.show', compact('product', 'photos', 'mainPhoto'));
    }

}
