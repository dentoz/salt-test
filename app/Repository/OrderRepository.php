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

    public function getOrder($orderId, User $user)
    {
        $order = Orders::where('order_id', $orderId)->first();
        $variant = new $order->order_type;
        return $variant->findWhere($orderId, $user)->first();
    }

    public function getOrderById($orderId)
    {
        $orders = Orders::where('order_id', 'like', '%' . $orderId .'%')->get();
        $result = [];
        foreach ($orders as $order) {
            $result[] = [
                'label' => $order->order_id,
                'value' => $order->order_id
            ];
        }

        return $result;
    }

    public function pay($orderId, User $user)
    {
        $orders = Orders::find($orderId);
        $variant = new $orders->order_type;

        if ( $variant->findWhere($orderId, $user)->exists() ) {
            $orders->is_paid = true;
            $orders->saveOrFail();
            return $orders;
        } else {
            return false;
        }
    }

    private function orderQuery($orderId)
    {
        if ( !empty( $orderId ) ) {
            return Orders::where('order_id', 'like', '%' . $orderId . '%')->orderBy('order_id');
        } else {
            return Orders::orderBy('order_id');
        }
    }

    public function getPaginatedOrders($page, $perRow, $orderId)
    {
        return $this->orderQuery($orderId)->skip($page * $perRow)->take($perRow)->get();
    }

    public function countPaginatedOrders($orderId)
    {
        return $this->orderQuery($orderId)->count();
    }

    public function getUnpaidOrderByOrder()
    {
        return Orders::where('is_paid', 0)->count();
    }
}
