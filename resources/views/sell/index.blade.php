@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-index">

            <div class="h2">Thousand of art lovers can’t wait to see your art</div>

{{--            @if(auth()->user())--}}

                <a href="/sell/profile-name" class="el-button el-button--default is-plain" style="margin-top: 20px;">Start to Sell</a>

            {{--@else--}}

                {{--<div style="text-align: center;padding: 20px 0;">--}}

                    {{--<modal-login-form>--}}
                        {{--<el-button plain>Login</el-button>--}}
                    {{--</modal-login-form>--}}
                    {{--<br>--}}
                    {{--or--}}
                    {{--<br>--}}
                    {{--<br>--}}
                    {{--<modal-register-form>--}}
                        {{--<el-button plain>Sign up</el-button>--}}
                    {{--</modal-register-form>--}}
                    {{--<br>--}}
                    {{--to sell on BearteSpace--}}

                {{--</div>--}}

            {{--@endif--}}

            <div class="h3" style="margin-top: 30px;">Need to make texts for this page</div>
            <p>Here we say about 2(3) subscription plans. 1 is free. 2 is 100eur/month and include publishing artworks in social media once a week + google search payed campaign</p>
            <p>3 could be 200eur for advertising in SoMe + goggle ads for one month</p>

        </div>
    </div>
@stop