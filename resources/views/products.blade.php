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
    <h3>Top-up</h3>

    @if ( $errors->count() > 0 )
      <p>The following errors have occurred:</p>

      <ul>
        @foreach( $errors->all() as $message )
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    @endif

    <form method="post" action="/products/process">
        @csrf <!-- {{ csrf_field() }} -->
        <div>
            <label>Product</label>
            <input type="textarea" name="name" value="{{old('name')}}"/>
        </div>
        <div>
            <label>Shipping Address</label>
            <input type="textarea" name="address" value="{{old('address')}}"/>
        </div>
        <div>
            <label>Value</label>
            <input type="text" name="price" value="{{old('price')}}"/>
        </div>
        <div>
            <button type="submit">submit</button>
        </div>
    </form>
</div>
@endsection
