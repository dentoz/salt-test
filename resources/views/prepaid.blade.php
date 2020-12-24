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

    <form method="post" action="{{route('home')}}">
        @csrf <!-- {{ csrf_field() }} -->
        <div>
            <label>Mobile Number</label>
            <input type="text" name="phone" value="{{old('phone')}}"/>
        </div>
        <div>
            <label>Value</label>
            <select name="value">
                <option> - </option>
                @foreach ($values as $value)
                    <option value="{{ $value }}">{{ number_format($value, 0, ",", ".") }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit">submit</button>
        </div>
    </form>
</div>
@endsection
