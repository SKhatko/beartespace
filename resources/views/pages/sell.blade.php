@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell">

            <div class="h2">Thousand of art lovers can’t wait to see your art</div>

            @if(auth()->user())


            @else

                <div>
                    <a href="/register" class="el-button el-button--default is-plain"
                       style="margin-top: 40px;">Register</a> or
                    <a href="/login" class="el-button el-button--default is-plain">Sign up</a> to sell on BearteSpace
                </div>

            @endif

            <div class="h3" style="margin-top: 30px;">Need to make texts for this page</div>
        </div>
    </div>
@stop