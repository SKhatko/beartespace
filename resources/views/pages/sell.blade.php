@extends('layouts.simple')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell">

            <div class="h2">Thousand of art lovers can’t wait to see your art</div>

            <a href="/register" class="el-button el-button--default is-plain" style="margin-top: 40px;">Start to sell on BearteSpace</a>
        </div>
    </div>
@stop