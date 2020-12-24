<?php

namespace App\Repository;

use App\Models\Orders;
use App\Models\Prepaid;

class OrderRepository
{
    public function create(Prepaid $prepaid, string $class, int $isSuccess)
    {
        $orders = new Orders();
        $orders->is_paid = 0;
        $orders->is_success = $isSuccess;
        $orders->order_id = $prepaid->prepaid_id;
        $orders->order_type = $class;
        $orders->saveOrFail();
    }
}
