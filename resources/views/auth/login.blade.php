@extends('layout')

@section('content')
<div class="bs-docs-section">
    <div class="row">
        <div class="col-lg-12">
        <div class="page-header">
            <h1 id="forms">{{ __('Login') }}</h1>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
        <div class="well bs-component">
            <form method="POST" action="{{ route('login') }}" class="form-horizontal">
            {{ csrf_field() }}
            <fieldset>
                {{-- <legend>{{ __('Login form') }}</legend> --}}
                
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">{{ __('Email') }}</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="email" placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">{{ __('Password') }}</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="password" name="password" >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <div class="checkbox">
                            <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </div>
                </div>

            </fieldset>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
