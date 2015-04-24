<?php namespace App\Http\Controllers\Admin;

use App\Facades\MyHelperFacade;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\MyHelper;
use Illuminate\Http\Request;
use App\Category;

class AdminController extends Controller {

    protected $helper;

    public function __construct(MyHelper $helper)
    {
        $this->middleware('admin');
        $this->helper = $helper;
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

        return view('admin.categories', ['categories' => $categories])->with(['helper' => $this->helper]);
    }

    public function getTest()
    {
        return \MyHelperFacade::test();
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
