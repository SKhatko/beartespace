@extends('dashboard.index')

@section('admin-content')

    <el-card>

        <el-row :gutter="10" style="margin-bottom:10px;">

            <el-col style="margin-bottom: 10px;">
                <el-card shadow="hover">
                    <div style="text-align: center;" class="h1">{{ currency($user->balance) }}</div>
                    <div style="text-align: center;" class="h3">Account Balance</div>
                </el-card>
            </el-col>

            <el-col :span="8">
                <el-card shadow="hover">
                    <div class="text-center">{{ $approved_ads }}</div>
                    <div>@lang('app.approved_ads')</div>
                </el-card>
            </el-col>

            <el-col :span="8">
                <el-card shadow="hover">
                    <div class="huge">{{ $blocked_ads }}</div>
                    <div>@lang('app.blocked_ads')</div>
                </el-card>
            </el-col>

            <el-col :span="8">
                <el-card shadow="hover">
                    <div class="huge">{{ $pending_ads }}</div>
                    <div>@lang('app.pending_ads')</div>
                </el-card>
            </el-col>

        </el-row>


        @if($ten_contact_messages)


            <el-row :gutter="10" style="margin-bottom: 10px;">

                <el-col :span="8">
                    <el-card shadow="hover">
                        <div class="huge">{{ $total_users }}</div>
                        <div>@lang('app.users')</div>
                    </el-card>
                </el-col>

                <el-col :span="8">
                    <el-card shadow="hover">
                        <div class="huge">{{ $total_reports }}</div>
                        <div>@lang('app.reports')</div>
                    </el-card>
                </el-col>

                <el-col :span="8">
                    <el-card shadow="hover">
                        <div class="huge">{{ $total_payments }}</div>
                        <div>@lang('app.success_payments')</div>
                    </el-card>
                </el-col>


            </el-row>


            <el-col>
                <el-card shadow="hover">
                    <div class="huge">  {{ $total_payments_amount }}
                        <sup>currency_sign</sup></div>
                    <div>@lang('app.total_payment')</div>
                </el-card>
            </el-col>

        @endif


        @if(auth()->user()->isAdmin())
            <div class="row">
                @if($ten_contact_messages)
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @lang('app.latest_ten_contact_messages')
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>@lang('app.sender')</th>
                                        <th>@lang('app.message')</th>
                                    </tr>

                                    @foreach($ten_contact_messages as $message)
                                        <tr>
                                            <td>
                                                <i class="fa fa-user"></i> {{ $message->name }} <br/>
                                                <i class="fa fa-envelope-o"></i> {{ $message->email }} <br/>
                                                <i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}
                                            </td>
                                            <td>{{ $message->message }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                @if($reports)
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @lang('app.latest_ten_ads_report')
                            </div>
                            <div class="panel-body">

                                @if($reports->count() > 0)
                                    <table class="table table-bordered table-striped table-responsive">
                                        <tr>
                                            <th>@lang('app.reason')</th>
                                            <th>@lang('app.email')</th>
                                            <th>@lang('app.message')</th>
                                            <th>@lang('app.ad_info')</th>
                                        </tr>

                                        @foreach($reports as $report)
                                            <tr>
                                                <td>{{ $report->reason }}</td>
                                                <td> {{ $report->email }}  </td>
                                                <td>
                                                    {{ $report->message }}
                                                    <hr/>
                                                    <p class="text-muted"><i>@lang('app.date_time')
                                                            : {{ $report->posting_datetime() }}</i></p>
                                                </td>
                                                <td>
                                                    @if($report->ad)
                                                        <a href="{{ route('single_ad', [$report->ad->id, $report->ad->slug]) }}"
                                                           target="_blank">@lang('app.view_ad')</a>
                                                        <i class="clearfix"></i>
                                                        <a href="{{ route('reports_by_ads', $report->ad->slug) }}">
                                                            <i class="fa fa-exclamation-triangle"></i> @lang('app.reports')
                                                            : {{ $report->ad->reports->count() }}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </el-card>

@endsection