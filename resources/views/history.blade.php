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
    <div>
        &nbsp;
        <form method="get">
            <div>
                <input type="text" name="order_id"/>
            </div>
            <div>
                <button type="submit">search</button>
            </div>
        </form>
        &nbsp;
        @foreach ($orders as $order)
            <div>
                {{ $order->prepaid ? $order->prepaid->created_at : $order->product->created_at }}
                &nbsp;&nbsp;
                {{ $order->prepaid ? $order->prepaid->getRawOriginal('value') : $order->product->getRawOriginal('price') }}
            </div>
            <div>
                {{ $order->prepaid ? $order->prepaid->value . ' for ' . $order->prepaid->phone_number : $order->product->name . ' that costs ' . $order->product->price }}
                {{ $order->prepaid ? ($order->is_paid && $order->is_success ? "balance successfully paid" : "balance failed to paid ") : ($order->product->shipping_code ? $order->product->shipping_code . " is successully paid" : "failed to paid")}}
                @if ($order->prepaid)
                    @if (!$order->is_paid && !$order->is_success)
                        <a href="/order/pay-order/{{$order->order_id}}">pay now?</a>
                    @endif
                @else
                    @if (empty($order->product->shipping_code))
                        <a href="/order/pay-order/{{$order->order_id}}">pay now?</a>
                    @endif
                @endif
            </div>
        @endforeach
        @for ($i = 0; $i < ceil($countOrders / 20); $i++)
            <a href="/order/history?page={{$i}}&perRow=20">{{$i+1}}</a>
        @endfor
    </div>
@endsection
