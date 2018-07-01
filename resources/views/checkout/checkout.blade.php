@extends('layouts.app')

@section('content')

    <div class="app--wrapper">
        <el-card>
            Checkout section

            @if(auth()->user())



            @else

            @endif

        </el-card>
    </div>


@stop