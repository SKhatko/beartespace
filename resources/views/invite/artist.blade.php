@extends('layouts.app')

@section('title') Artist Registration | @parent @endsection

@section('content')

    <div class="app--wrapper">
        Artist invitation and registration

        <register-form user-type="artist"></register-form>

    </div>

@endsection
