@extends('layouts.simple')

@section('content')

    <div class="app--wrapper">
        <el-card>
            Checkout section

            @if(auth()->user())


                Logged in

            @else

            @endif

        </el-card>
    </div>


@stop