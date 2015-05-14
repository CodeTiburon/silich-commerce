<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\OrderProcessor;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller {

    protected $order;

    public function __construct(OrderProcessor $order)
    {
        $this->middleware('user');
        $this->order = $order;
    }

	public function getIndex()
    {
        return view('order.index');
    }

    public function postCreate(Request $request)
    {
        $products = Session::get('products');
        $productsQuantity = array_count_values($products);
        $user = \Auth::user()->name;

        $finalRequest = $request->all();
        $finalRequest['user_id'] = $user;
        $this->order->create($finalRequest);
    }

}
