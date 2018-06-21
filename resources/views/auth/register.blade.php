@extends('layouts.app')

@section('content')


    <div class="app-register">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default login-form">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                            @include('admin.flash_msg')

                            <form method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="col-md-4 control-label">
                                        First name
                                    </label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                                               required autofocus>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="col-md-4 control-label">
                                        Last name
                                    </label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                                               required autofocus>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">@lang('app.email_address')</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                               required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">@lang('app.password')</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm"
                                           class="col-md-4 control-label">@lang('app.confirm_password')</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </div>
                                </div>

                                @if(get_option('enable_recaptcha_registration') == 1)
                                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="g-recaptcha" data-sitekey="{{get_option('recaptcha_site_key')}}"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-user-plus"></i> @lang('app.register')
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
