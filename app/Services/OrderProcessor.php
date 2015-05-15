<?php namespace App\Services;


use App\Models\Order;
use App\Models\Order_Product;
use Validator;

class OrderProcessor {

    /** Validate incoming order request
     * @param array $data
     * @return mixed
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'address' => 'required',
            'telephone' => 'required'
        ]);
    }

    /**
     * Create order and related table rows
     * @param array $data
     * @param array $products
     */
    public function create(array $data, array $products)
    {
        Order::create([
            'user_id' => $data['user_id'],
            'address' => $data['address'],
            'telephone' => $data['telephone']
        ]);


        foreach($products as $key => $value) {

            $orderId = Order::latest()->first()['id'];
            Order_Product::create([
                'order_id' => $orderId,
                'product_id' => $key,
                'quantity' => $value
            ]);

            }
    }

} 