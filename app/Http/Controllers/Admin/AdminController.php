<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\MyHelper;
use App\Category;
use Request;

class AdminController extends Controller {


    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('admin.index');
    }

    public function getCategories()
    {
        $categories = Category::all()->toHierarchy();

        return view('admin.categories', ['categories' => $categories]);
    }

    public function postAdd()
    {
        $root = Category::where('id', '=', Request::input('data_id'))->first();
        $child = Category::create(['name' => Request::input('new_category')]);
        $child->makeChildOf($root);
    }

    public function postSibling()
    {
        $root = Category::where('id', '=', Request::input('data_id'))->first();
        $child = Category::create(['name' => Request::input('new_category')]);
        $child->makeSiblingOf($root);
    }

    public function postDelete()
    {
        $element = Category::where('id', '=', Request::input('data_id'))->first();
        $element->delete();
    }

    public function getTest()
    {
        dd(Category::isValidNestedSet());
    }



//    public function getAdd()
//    {
//
//
////        $root = Category::where('id', '=', '4')->first();
////        $child = Category::create(['name' => 'MSi']);
////        $child->makeChildOf($root);
//
//    }
    //Default tree

//    public function getMake()
//    {
//
//        $categories = [
//            ['id' => 1 ],
//            ['id' => 2 ],
//            ['id' => 3,  'children' => [
//                ['id' => 4,  'children' => [
//                    ['id' => 5],
//                    ['id' => 6]
//                ]],
//                ['id' => 7],
//                ['id' => 8]
//            ]],
//            ['id' => 9]
//        ];
//
//        if(Category::buildTree($categories)) {
//            return 'Success';
//        } else {
//            return 'No';
//        }
//
//    }

}
