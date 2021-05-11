@extends('layouts.horizontal', ['title' => 'Dashboard'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
{{--                    <div class="page-title-right">--}}
{{--                        <form class="form-inline">--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="input-group input-group-sm">--}}
{{--                                    <input type="text" class="form-control border" id="dash-daterange">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text bg-blue border-blue text-white">--}}
{{--                                            <i class="mdi mdi-calendar-range"></i>--}}
{{--                                        </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">--}}
{{--                                <i class="mdi mdi-autorenew"></i>--}}
{{--                            </a>--}}
{{--                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">--}}
{{--                                <i class="mdi mdi-filter-variant"></i>--}}
{{--                            </a>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                    <h4 class="page-title">{{__('tableau de bord')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
{{--            @hasrole('user')--}}
            <div class="col-md-4 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-credit-card font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="mt-1"><span data-plugin="counterup">{{$abonnements}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Abonnements')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-4 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-user font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$clients}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Clients')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-4 col-xl-3">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$money}}</span> {{__('Tnd')}}</h3>
                                <p class="text-muted mb-1 text-truncate">{{__('Revenue')}}</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
{{--            @endhasrole--}}
        </div>
        <!-- end row-->

        <div class="row">
{{--            <div class="col-lg-4">--}}
{{--                <div class="card-box">--}}
{{--                    <div class="dropdown float-right">--}}
{{--                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">--}}
{{--                            <i class="mdi mdi-dots-vertical"></i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>--}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>--}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>--}}
{{--                            <!-- item-->--}}
{{--                            <a href="javascript:void(0);" class="dropdown-item">Action</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <h4 class="header-title mb-0">Total Revenue</h4>--}}

{{--                    <div class="widget-chart text-center" dir="ltr">--}}

{{--                        <div id="total-revenue" class="mt-0"  data-colors="#f1556c"></div>--}}

{{--                        <h5 class="text-muted mt-0">Total sales made today</h5>--}}
{{--                        <h2>$178</h2>--}}

{{--                        <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading elements are designed to work best in the meat of your page content.</p>--}}

{{--                        <div class="row mt-3">--}}
{{--                            <div class="col-4">--}}
{{--                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>--}}
{{--                                <h4><i class="fe-arrow-down text-danger mr-1"></i>$7.8k</h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-4">--}}
{{--                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>--}}
{{--                                <h4><i class="fe-arrow-up text-success mr-1"></i>$1.4k</h4>--}}
{{--                            </div>--}}
{{--                            <div class="col-4">--}}
{{--                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>--}}
{{--                                <h4><i class="fe-arrow-down text-danger mr-1"></i>$15k</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div> <!-- end card-box -->--}}
{{--            </div> <!-- end col-->--}}

            <div class="col-lg-12">
                <div class="card-box pb-2">
                    <div class="float-right d-none d-md-inline-block">
                        <div class="btn-group mb-2">
{{--                            <button type="button" class="btn btn-xs btn-light">Today</button>--}}
{{--                            <button type="button" class="btn btn-xs btn-light">Weekly</button>--}}
                            <button type="button" class="btn btn-xs btn-secondary">{{__('Mensuel')}}</button>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">{{__('Analyse des ventes')}}</h4>

                    <div dir="ltr">
                        <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
    <!-- Plugins js-->
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

    <!-- Page js-->
{{--    <script>--}}
{{--        function generateDayWiseTimeSeries(baseval, count, yrange) {--}}
{{--            var i = 0;--}}
{{--            var series = [];--}}
{{--            while (i < count) {--}}
{{--                var x = baseval;--}}
{{--                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;--}}

{{--                series.push([x, y]);--}}
{{--                baseval += 86400000;--}}
{{--                i++;--}}
{{--            }--}}
{{--            return series;--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        /*--}}
{{--Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard--}}
{{--Author: CoderThemes--}}
{{--Website: https://coderthemes.com/--}}
{{--Contact: support@coderthemes.com--}}
{{--File: Dashboard 1 init--}}
{{--*/--}}

{{--        //--}}
{{--        // Total Revenue--}}
{{--        //--}}
{{--        var colors = ['#f1556c'];--}}
{{--        var dataColors = $("#total-revenue").data('colors');--}}
{{--        if (dataColors) {--}}
{{--            colors = dataColors.split(",");--}}
{{--        }--}}
{{--        var options = {--}}
{{--            series: [68],--}}
{{--            chart: {--}}
{{--                height: 220,--}}
{{--                type: 'radialBar',--}}
{{--            },--}}
{{--            plotOptions: {--}}
{{--                radialBar: {--}}
{{--                    hollow: {--}}
{{--                        size: '65%',--}}
{{--                    }--}}
{{--                },--}}
{{--            },--}}
{{--            colors: colors,--}}
{{--            labels: ['Revenue'],--}}
{{--        };--}}

{{--        var chart = new ApexCharts(document.querySelector("#total-revenue"), options);--}}
{{--        chart.render();--}}



{{--        //Sales Analytics--}}

{{--        var colors = ['#1abc9c', '#4a81d4'];--}}
{{--        var dataColors = $("#sales-analytics").data('colors');--}}
{{--        if (dataColors) {--}}
{{--        	colors = dataColors.split(",");--}}
{{--        }--}}

{{--        var options = {--}}
{{--        	series: [{--}}
{{--        		name: '{{__('Abonnements')}}',--}}
{{--        		type: 'column',--}}
{{--        		data: [--}}
{{--                    @foreach($initsubscrips ?? '' as $initsubscrip)--}}
{{--                        '{{$initsubscrip}}',--}}
{{--                    @endforeach--}}
{{--                ]--}}
{{--        	}, {--}}
{{--        		name: '{{__('Prix')}}',--}}
{{--        		type: 'line',--}}
{{--        		data: [--}}
{{--                    @foreach($initprixsubscrips as $initprixsubscrip)--}}
{{--                        '{{$initprixsubscrip}}',--}}
{{--                    @endforeach--}}
{{--                ]--}}
{{--        	}],--}}
{{--        	chart: {--}}
{{--        		height: 378,--}}
{{--        		type: 'line',--}}
{{--        	},--}}
{{--        	stroke: {--}}
{{--        		width: [2, 3]--}}
{{--        	},--}}
{{--        	plotOptions: {--}}
{{--        		bar: {--}}
{{--        			columnWidth: '50%'--}}
{{--        		}--}}
{{--        	},--}}
{{--        	colors: colors,--}}
{{--        	dataLabels: {--}}
{{--        		enabled: true,--}}
{{--        		enabledOnSeries: [1]--}}
{{--        	},--}}
{{--        	labels: [--}}
{{--        	    @foreach($labels as $label)--}}
{{--                '{{$label}}',--}}
{{--                @endforeach--}}
{{--            ],--}}
{{--        	xaxis: {--}}
{{--        		type: 'datetime'--}}
{{--        	},--}}
{{--        	legend: {--}}
{{--                offsetY: 7,--}}
{{--        	},--}}
{{--        	grid: {--}}
{{--        		padding: {--}}
{{--        		  bottom: 20--}}
{{--        		}--}}
{{--        	},--}}
{{--        	fill: {--}}
{{--        		type: 'gradient',--}}
{{--        		gradient: {--}}
{{--        			shade: 'light',--}}
{{--        			type: "horizontal",--}}
{{--        			shadeIntensity: 0.25,--}}
{{--        			gradientToColors: undefined,--}}
{{--        			inverseColors: true,--}}
{{--        			opacityFrom: 0.75,--}}
{{--        			opacityTo: 0.75,--}}
{{--        			stops: [0, 0, 0]--}}
{{--        		},--}}
{{--        	},--}}
{{--        	yaxis: [{--}}
{{--        		title: {--}}
{{--        			text: '{{__('Abonnements')}}',--}}
{{--        		},--}}

{{--        	}, {--}}
{{--        		opposite: true,--}}
{{--        		title: {--}}
{{--        			text: '{{__('prix')}}'--}}
{{--        		}--}}
{{--        	}]--}}
{{--        };--}}

{{--        var chart = new ApexCharts(document.querySelector("#sales-analytics"), options);--}}
{{--        chart.render();--}}

{{--        // Datepicker--}}
{{--        $('#dash-daterange').flatpickr({--}}
{{--            altInput: true,--}}
{{--            mode: "range",--}}
{{--            altFormat: "F j, y",--}}
{{--            defaultDate: 'today'--}}
{{--        });--}}

{{--    </script>--}}
@endsection
