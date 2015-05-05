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
        return view('admin.products.show', compact('product'));
    }


    public function patchUpdate($id, RequestValidation $request)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect('admin/products');
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        Photo::where('product_id', '=', $id)->delete();
    }

}
