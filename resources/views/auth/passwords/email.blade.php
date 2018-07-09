@extends('layouts.app')

@section('content')

    <el-main class="app-auth">

        <el-card class="box-card app-auth-email">
            <div slot="header">Reset Password</div>

            @include('partials.errors')

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <el-form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <el-form-item label="E-Mail Address" required>
                    <el-input type="email" placeholder="Email" value="{{ old('email') }}" name="email"
                              autofocus></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Send Restore Link</el-button>

                    <el-button type="text">
                        <a href="{{ route('signup') }}">
                            Create New User
                        </a>
                    </el-button>

                </el-form-item>

            </el-form>

        </el-card>

    </el-main>

@endsection

