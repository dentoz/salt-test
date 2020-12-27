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

    public function process(Request $request, OrderRepository $orderRepository)
    {
        $me = auth()->user();
        $orderRepository->pay($request->get('order_id'), $me);
        return redirect()->route('history');
    }

    public function history(Request $request, OrderRepository $orderRepository)
    {
        $me = auth()->user();
        $counter = $orderRepository->getUnpaidOrderByOrder();

        $page = $request->get('page') ?? 0;
        $perRow = $request->get('perRow') ?? 20;
        $orders = $orderRepository->getPaginatedOrders($page, $perRow, $request->get('order_id'));
        $countOrders = $orderRepository->countPaginatedOrders($request->get('order_id'));
        return view('history', [
            'me' => $me,
            'counter' => $counter,
            'orders' => $orders,
            'countOrders' => $countOrders
        ]);
    }
}
