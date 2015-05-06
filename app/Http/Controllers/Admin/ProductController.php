<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Photo;
use App\Product;
use App\Services\ProductFile;
use Illuminate\Http\Request as RequestValidation;
use Illuminate\Contracts\Filesystem\Filesystem;
use Request;

class ProductController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

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
        $categories = Category::all();

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
            'file' => 'required',
            'categories_list' => 'required'
        ]);
        $files = Request::file('file');

        return $uploader->insertProduct($request, $files);
    }

    public function getEdit($id)
    {
        $product = Product::find($id);

        $photos = Photo::where('product_id', '=', $id)->get();
        $mainPhoto = Photo::where('id', '=', $product->photo_id)->first()->title;

        $categories = Category::all();
        $currentCategories = $product->categories()->lists('name');

        return view('admin.products.show', compact('product', 'photos', 'mainPhoto', 'categories', 'currentCategories'));
    }


    public function patchUpdate($id, RequestValidation $request, ProductFile $uploader)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'categories_list' => 'required'
        ]);
        $product = Product::findOrFail($id);

        $product->update($request->all());
        $uploader->syncCategory($product, $request->input('categories_list'));

        return response()->json([
            "redirectTo" => './../'
        ]);
    }

    public function postDelete($id, Filesystem $fileDelete)
    {
        $files = Photo::where('product_id', '=', $id)->get();
        Product::find($id)->delete();
        foreach($files as $file) {
            $fileName = $file->title;
            $absoluteParse = parse_url($fileName);
            $absolutePath = $absoluteParse['path'];
            unlink('/var/www/html/test1.com/public' . $absolutePath);
        }
    }

}
