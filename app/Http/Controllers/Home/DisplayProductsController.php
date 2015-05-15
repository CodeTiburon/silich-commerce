<?php namespace App\Http\Controllers\Home;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Photo;
use App\Product;
use Request;


class DisplayProductsController extends Controller {


    /**
     * Displays all categories availbale for the user
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $categories = Category::all()->toHierarchy();
        return view('home.index', compact('categories'));
    }

    /**
     *  Display products if they are available in the category
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function postDisplayProducts()
    {
        $category = Category::find(Request::input('category_id'));


        $paginatedProducts = $category->products()->paginate(2);

        foreach ($paginatedProducts as $product) {
            $photoId = $product->photo_id;

            $photo = Photo::find($photoId);

            if ($photo == null) {
                $product['photo'] = 'http://test1.com/assets/uploads/no-thumb.png';
            } else {
                $product['photo'] = $photo->title;
            }
        }
        $paginationLinks = $paginatedProducts->render();

        return response()->json([
            'products' => $paginatedProducts->toArray()['data'],
            'pagination' => $paginationLinks
        ]);
    }

    /**
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postShow($id)
    {
        return response()->json([
            'redirectTo' => '/products/show-product/' . $id
        ]);
    }

    /**
     * Show certain product
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getShowProduct($id)
    {
        $product = Product::find($id);
        $mainPhoto = Photo::find($product->photo_id);
        $photos = Photo::where('product_id', '=', $id)->get();
        return view('home.show', compact('product', 'photos', 'mainPhoto'));
    }

}
