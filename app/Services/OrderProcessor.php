<?php namespace App\Services;


use App\Models\Order;

class OrderProcessor {

    public function create(array $data)
    {
        return Order::create([
            'user_id' => $data['user_id'],
            'address' => $data['address'],
            'telephone' => $data['telephone']
        ]);
    }

} 