<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index($orderId, OrderRepository $orderRepository)
    {
        $me = auth()->user();
        $order = $orderRepository->getOrder($orderId, $me);
        $counter = $orderRepository->getUnpaidOrder($me, $order);
        return view('pay-order', [
            'order' => $order,
            'me' => $me,
            'counter' => $counter,
        ]);
    }

    public function autocomplete(Request $request, OrderRepository $orderRepository)
    {
        return $orderRepository->getOrderById($request['search']);
    }

    public function getOrder(Request $request, OrderRepository $orderRepository)
    {
        $me = auth()->user();
        $order = $orderRepository->getOrder($request['order_id'], $me);
        return $order;
    }

    public function process(Orders $orders, OrderRepository $orderRepository)
    {
        $orderRepository->pay($orders);
        return redirect()->route('history');
    }
}
