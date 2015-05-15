<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\OrderProcessor;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller {

    /**
     * Service for handling incoming request
     * @var OrderProcessor
     */
    protected $order;

    /**
     * @param OrderProcessor $order
     */
    public function __construct(OrderProcessor $order)
    {
        $this->middleware('user');
        $this->order = $order;
    }

    /**
     * Display order window
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('order.index');
    }

    /**
     * Create new order
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postCreate(Request $request)
    {
        $products = Session::get('products');
        $productsQuantity = array_count_values($products);
        $user = \Auth::user()->id;

        $finalRequest = $request->all();
        $finalRequest['user_id'] = $user;

        $validator = $this->order->validator($finalRequest);

        if ($validator->fails()) {
            return response()->json([
                'fail' => 'true',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {
            $this->order->create($finalRequest, $productsQuantity);
            Session::forget('products');
            session()->flash('flash_message', 'Your order was stored successfully');
            return response()->json([
                'redirectTo' => '/'
            ]);
        }
    }

}
