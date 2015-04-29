<?php namespace App\Traits;

use App\Category;
use App\Product;
use Illuminate\Http\Request as RequestValidation;
use Request;

trait ProductManagment {

    public function getProducts()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();


        return view('admin.products.create', compact('categories'));
    }

    public function create(RequestValidation $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'description' => 'required',
//            'file' => 'require',
//            'categories_list' => 'required'
//        ]);
//        $file =  ['file' => Request::file('file')];
//        $rules = ['file' => 'required|image'];
//
//        $validator = \Validator::make($file, $rules);
//
//        if($validator->fails()) {
//            return redirect()->back()->withInput();
//        }
//        else {
//            if(Request::file('file')->isValid()) {
//                echo 3;
//            }
//        }
//        $files = $file->getClientOriginalName();
        $this->insertProduct($request);

    }

    /**
     * Create new product
     * @param RequestValidation $request
     */
    private function insertProduct(RequestValidation $request)
    {
        $product = Product::create($request->all());
        $this->syncCategory($product, $request->input('categories_list'));
    }

    /**
     * Insert into pivot table
     * @param Product $product
     * @param array $categories
     */
    private function syncCategory(Product $product, array $categories)
    {
        $product->categories()->sync($categories);
    }
}