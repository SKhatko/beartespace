@extends('dashboard.index')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')


    @include('admin.flash_msg')

    @include('partials.errors')

    <el-form method="POST" action="{{ route('artwork.store') }}">

        1. Category select<br>
        2. ad_title input<br>
        3. ad_description textarea<br>
        4. price input<br>
        5. bid_deadline dateinput<br>
        6. Up to 3 images upload<br>


        <!-- TODO fix recaptcha -->

        {{--@if(get_option('enable_recaptcha_post_ad') == 1)--}}
        {{--<div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">--}}
        {{--<div class="col-md-6 col-md-offset-4">--}}
        {{--<div class="g-recaptcha" data-sitekey="{{get_option('recaptcha_site_key')}}"></div>--}}
        {{--@if ($errors->has('g-recaptcha-response'))--}}
        {{--<span class="help-block"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}

    </el-form>


@endsection
