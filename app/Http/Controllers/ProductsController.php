<?php

namespace App\Http\Controllers;

use App\enum\Value;
use App\Http\request\ProductsRequest;
use App\Models\Products;
use App\Repository\OrderRepository;
use App\Repository\ProductsRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Products $products, OrderRepository $orderRepository)
    {
        $me = auth()->user();
        $counter = $orderRepository->getUnpaidOrder($me, $products);
        return view('products', [
            'me' => $me,
            'counter' => $counter,
            'values' => Value::getValues()
        ]);
    }

    public function process(ProductsRequest $productsRequest,ProductsRepository $productsRepository)
    {
        $me = auth()->user();
        $input = $productsRequest->validated();
        $product = $productsRepository->create($input, $me);
        return redirect('/products/result/' . $product->product_id);
    }

    public function result(Products $products, OrderRepository $orderRepository)
    {
        $me = auth()->user();
        $counter = $orderRepository->getUnpaidOrder($me, $products);
        $order = $products->order;

        return view('result', [
            'me' => $me,
            'counter' => $counter,
            'products' => $products,
            'title' => "Success",
            'order_number' => $order->order_id,
            'total' => $products->price + 10000,
            'date' => $products->created_at
        ]);
    }
}
