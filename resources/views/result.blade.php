@extends('layout.main')

@section('head')
    <div>
        <p>hi {{ $me->name ? $me->name : $me->email }}</p>
        <p>Your have {{ $counter }} unpaid order(s)</p>
    </div>
    <div>
        <div><a href="{{ route('home') }}">Top-up Page</a> | <a href="{{ route('products') }}">Product Page</a></div>
    </div>
@endsection

@section('content')
    <h3>{{ $title }}</h3>
    <p>Order no. {{ $order_number }}</p>
    <p>Total {{ $total }}</p>
    @if (isset($prepaid->phone_number) && isset($prepaid->value))
        <p>Your mobile phone number {{ $prepaid->phone_number }} will receive Rp {{ $prepaid->value }}</p>
    @else
        <p>{{ $products->name }} that costs {{ $total }} will be shipped to : {{ $products->address }} only after you pay</p>
    @endif

    <a href="/order/pay-order/{{ $order_number }}">Pay Order</a>
@endsection
