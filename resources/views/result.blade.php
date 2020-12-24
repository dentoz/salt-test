@extends('layout.main')

@section('head')
    <div>
        <p>hi {{ $me->name ? $me->name : $me->email }}</p>
        <p>Your have {{ $counter }} unpaid order(s)</p>
    </div>
    <div>
        <div><a href="prepaid">Top-up Page</a> | <a href="product">Product Page</a></div>
    </div>
@endsection

@section('content')
    <h3>{{ $title }}</h3>
    <p>Order no. {{ $order_number }}</p>
    <p>Total {{ $total }}</p>
    <p>Your mobile phone number {{ $prepaid->phone_number }} will receive Rp {{ $prepaid->value }}</p>
    <a href="/prepaid/pay-order/{{ $order_number }}">Pay Order</a>
@endsection
