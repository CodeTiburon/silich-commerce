<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Photo;
use App\Product;
use App\Services\ProductFile;
use Illuminate\Http\Request as RequestValidation;
use Request;

class ProductController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display all products
     * @return \Illuminate\View\View
     */

    public function getIndex()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * View all products
     * @return \Illuminate\View\View
     */

    public function getCreate()
    {
        $categories = Category::all()->toHierarchy();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Inserts product into table
     * @param RequestValidation $request
     * @param ProductFile $uploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postCreate(RequestValidation $request, ProductFile $uploader)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'file' => 'required',
            'categories_list' => 'required'
        ]);
        $files = Request::file('file');

        return $uploader->insertProduct($request, $files);
    }

    /**
     * Edit existing article, pass information from db to form
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $product = Product::find($id);

        $photos = Photo::where('product_id', '=', $id)->get();
        $mainPhoto = Photo::where('id', '=', $product->photo_id)->first();

        $categories = Category::all()->toHierarchy();
        $currentCategories = $product->categories()->lists('name');

        return view('admin.products.show', compact('product', 'photos', 'mainPhoto', 'categories', 'currentCategories'));
    }


    /**
     * Update an existing file
     * @param $id
     * @param RequestValidation $request
     * @param ProductFile $uploader
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function patchUpdate($id, RequestValidation $request, ProductFile $uploader)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'categories_list' => 'required',
        ]);
        $product = Product::findOrFail($id);

        $product->update($request->all());
        $uploader->syncCategory($product, $request->input('categories_list'));

        return response()->json([
            "redirectTo" => './../'
        ]);
    }

    /**
     * Delete a product and related images
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postDelete(ProductFile $fileHelper)
    {
        $id = Request::input('delete_id');
        $files = Photo::where('product_id', '=', $id)->get();
        Product::find($id)->delete();

        return $fileHelper->fileDelete($files);
    }


    /**
     * Make targeted photo primary
     * @param ProductFile $fileHelper
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postMakeMain(ProductFile $fileHelper)
    {
        $product = Product::find(Request::input('product_id'));
        $targetPhoto = Request::input('target_photo_id');
        return $fileHelper->makePrimary($product, $targetPhoto);
    }
}
