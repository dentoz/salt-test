@extends('layout.main')

@section('content')
<div>
    <h3>Register</h3>

    @if ( $errors->count() > 0 )
      <p>The following errors have occurred:</p>

      <ul>
        @foreach( $errors->all() as $message )
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    @endif

    <form method="post" action="{{route('register')}}">
        @csrf <!-- {{ csrf_field() }} -->
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{old('name')}}"/>
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="email" value="{{old('email')}}"/>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password"/>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</div>
@endSection
