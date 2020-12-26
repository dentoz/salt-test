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
        <h3>Pay your Order</h3>
        <form method="post" action="/order/process">
            @csrf <!-- {{ csrf_field() }} -->
            <div>
                <input type="text" name="order_id" placeholder="Order No." value="{{ $order->order->order_id }}"/>
            </div>
            <div class="total">
                <h3>Total : {{ number_format($order->price ?? $order->value, 0, ',', '.') }}</h3>
            </div>
            <div>
                <button type="submit">submit</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $( function() {
            $( "input[name='order_id']" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    $.ajax({
                        url: "/order/autocomplete",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: "id",
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $.ajax({
                        url: "/order/get-order/",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: "id",
                            order_id: ui.item.value
                        },
                        success: function( data ) {
                            let total = data.value ? data.value : data.price,
                                order_id = data.prepaid_id ? data.prepaid_id : data.product_id;
                            $('input[name="order_id"]').val(order_id)
                            $('.total').html('<h3>Total : ' + total + '</h3>')
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
