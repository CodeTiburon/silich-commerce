<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Request;
use Illuminate\Http\Request as RequestValidation;
use MyHelperFacade;

class CategoryController extends Controller {


    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $categories = Category::all()->toHierarchy();

        return view('admin.categories', ['categories' => $categories]);
    }


    /**
     * Add child category
     * @param RequestValidation $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function postAdd(RequestValidation $request)
    {
        $this->validate($request , [
            'new_category' => 'required'
        ]);

        return $this->getTargetCategory();

    }

    /**
     * Add sibling category
     * @param RequestValidation $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function postSibling(RequestValidation $request)
    {
        $this->validate($request , [
            'new_category' => 'required'
        ]);

        return $this->getTargetCategory();
    }

    /**
     * Delete target category
     */
    public function postDelete()
    {
        $element = Category::where('id', '=', Request::input('data_id'))->first();
        $element->delete();
    }

    public function getTest()
    {
        dd(Category::isValidNestedSet());
    }

    /**
     * Analyse and define what to do(add child or add sibling)
     * @return \Symfony\Component\HttpFoundation\Response
     */

    private function getTargetCategory()
    {
        $root = Category::where('id', '=', Request::input('data_id'))->first();
        $child = Category::create(['name' => Request::input('new_category')]);
        $target = Request::input('target');

        if ($target == 'add') {
            $child->makeChildOf($root);

        } else if ($target == 'sibling') {
            $child->makeSiblingOf($root);
        }

        return response()->json([
            'parentId' => $root->id,
            'myHtml' => MyHelperFacade::renderNode($child)
        ]);
    }

}
