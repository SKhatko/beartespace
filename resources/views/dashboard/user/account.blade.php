@extends('dashboard.index')

@section('dashboard-content')

    <div class="app-dashboard-account">

        @include('dashboard.partials.profile')

        <div class="account">
            <el-card>
                <el-tabs value="email">
                    {{--<el-tab-pane label="Account" name="account">--}}
                    {{----}}
                    {{--</el-tab-pane>--}}
                    <el-tab-pane label="Email" name="email">
                        <change-email-form></change-email-form>
                    </el-tab-pane>
                    <el-tab-pane label="Password" name="password">

                        <el-form method="POST" action="{{ route('dashboard.change-password') }}">

                            @include('partials.errors')

                            {{ csrf_field() }}

                            <el-form-item label="Old Password" required>
                                <el-input type="password" placeholder="Old Password" value="{{ old('email') }}"
                                          name="old_password"
                                          autofocus></el-input>
                            </el-form-item>

                            <el-form-item label="New Password" required>
                                <el-input type="password" placeholder="New password" value="{{ old('new_password') }}"
                                          name="new_password"></el-input>
                            </el-form-item>


                            <el-form-item label="Confirm New Password" required>
                                <el-input type="password" placeholder="Confirm New Password"
                                          value="{{ old('new_password_confirmation') }}"
                                          name="new_password_confirmation"></el-input>
                            </el-form-item>

                            <div class="app--fixed-bottom">
                                <div class="app--wrapper">

                                    <el-button type="primary" native-type="submit">Save new password</el-button>

                                </div>
                            </div>

                        </el-form>
                    </el-tab-pane>
                </el-tabs>
            </el-card>


        </div>

    </div>

@endsection