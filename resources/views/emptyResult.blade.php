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
    <p>Your order is almost finish, please refresh this page in 5 seconds</p>
@endsection
