@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <el-card>
            <h2>Contact Us</h2>

            @include('partials.errors')

            <el-form method="POST">

                {{ csrf_field() }}

                <el-form-item label="Your name">
                    <el-input value="" name="name"></el-input>
                </el-form-item>

                <el-form-item label="Your email">
                    <el-input type="email" name="email"></el-input>
                </el-form-item>

                <el-form-item label="Message">
                    <el-input type="textarea" name="message"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button native-type="submit" type="primary">Send message</el-button>
                </el-form-item>

            </el-form>

        </el-card>
    </div>

@endsection
