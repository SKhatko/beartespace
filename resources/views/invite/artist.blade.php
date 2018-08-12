@extends('layouts.app')

@section('title') Artist Registration | @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-invite">
            <div class="h2">Select Your Pricing Plan</div>

            <div class="pricing">

                <el-card shadow="hover" class="pricing-plan">
                    <div class="pricing-plan">
                        <div class="h4">Trial / Free</div>

                        <p>
                            <el-button type="success"><a href="/register?p=trial&u=artist">Continue</a></el-button>
                        </p>

                    </div>
                </el-card>

                <el-card shadow="hover" class="pricing-plan">
                    <div class="pricing-plan">
                        <div class="h4">Basic</div>

                        <p>
                            <el-button type="success"><a href="/register?p=basic&u=artist">Continue</a></el-button>
                        </p>
                    </div>
                </el-card>

                <el-card shadow="hover" class="pricing-plan">
                    <div class="pricing-plan">
                        <div class="h4">Expanded</div>

                        <p>
                            <el-button type="success"><a href="/register?p=expanded&u=artist">Continue</a></el-button>
                        </p>

                    </div>
                </el-card>

            </div>
        </div>

    </div>

@endsection
