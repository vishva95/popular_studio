@extends('layout.auth')

@section('content')
<form class="kt-form login_form" id="login_form"  role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Sign In</h3>
        </div>
    </div>

    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" autofocus>

    </div>

    @if ($errors->has('email'))
    <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
    <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" name="password" placeholder="Password">

        
    </div>
    @if ($errors->has('password'))
    <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
    <div class="kt-login__actions">
        <button type="submit" id="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Sign In</button>
    </div>
</form>
@endsection
