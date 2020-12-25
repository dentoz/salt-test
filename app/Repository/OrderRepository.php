<?php

namespace App\Repository;

use App\Models\Orders;
use App\Models\Prepaid;
use App\Models\Products;
use App\Models\User;

class OrderRepository
{
    public function getUnpaidOrder(User $user, $trans)
    {
        $transaction = $trans->where('user_id', $user->id)->first();
        return $transaction->order->where('is_paid', 0)->count();
    }

    public function create(Prepaid $prepaid, string $class, int $isSuccess)
    {
        $orders = new Orders();
        $orders->is_paid = 0;
        $orders->is_success = $isSuccess;
        $orders->order_id = $prepaid->prepaid_id;
        $orders->order_type = $class;
        $orders->saveOrFail();
    }

    public function createProducts(Products $products, string $class)
    {
        $orders = new Orders();
        $orders->is_paid = 0;
        $orders->order_id = $products->product_id;
        $orders->order_type = $class;
        $orders->saveOrFail();
    }
}
