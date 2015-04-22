<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;

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
