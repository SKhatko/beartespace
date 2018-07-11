@extends('layouts.app')
@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <el-main class="app-auth">

        <div style="text-align: center">

            <h1><i class="el-icon-warning"></i> Oops!</h1>
            <h2> 404 Not Found</h2>
            <div class="error-details">
                Sorry, an error has occured, Requested page not found!
            </div>
        </div>

    </el-main>

@endsection
