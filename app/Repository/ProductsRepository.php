<?php

namespace App\Repository;

use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Str;

class ProductsRepository
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create($input, User $user)
    {
        $products = new Products();
        $products->product_id = Str::orderedUuid();
        $products->shipping_code = 'SHP-' . str_pad( (Products::count() + 1), 4,  "0", STR_PAD_LEFT );
        $products->user_id = $user->id;
        $products->fill($input);
        $products->saveOrFail();

        $this->orderRepository->createProducts($products, Products::class);

        return $products;
    }
}
