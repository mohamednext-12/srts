@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Utilisateurs')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Afficher un Utilisateur')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Afficher un Utilisateur')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="{{$user->picture ? url('../storage/app/users/'.$user->picture) : asset('assets/images/user.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0">{{$user->name}}</h4>
                    <p class="text-muted"><i class="mdi mdi-office-building"></i>{{$user->agency->name_french}}</p>
                    <a href="{{route('users.edit',$user)}}" class="btn btn-success btn-xs waves-effect mb-2 waves-light ">{{__('Modifier')}}</a>

                    <div class="text-center mt-3">
{{--                        <h4 class="font-13 text-uppercase">About Me :</h4>--}}
{{--                        <p class="text-muted font-13 mb-3">--}}
{{--                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the--}}
{{--                            1500s, when an unknown printer took a galley of type.--}}
{{--                        </p>--}}
                        <p class="text-muted mb-2 font-13"><strong>{{__('Nom')}} :</strong> <span class="ml-2">{{$user->name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>{{__('Role')}} :</strong>
                            <span class="ml-2">
                                {{$role=='supervisor' ? __('superviseur') : ''}}
                                {{$role=='user' ? __('Utilisateur') : ''}}
                                {{$role=='user' ? __('administrateur') : ''}}
                            </span>
                        </p>

                        <p class="text-muted mb-2 font-13"><strong>{{__('Email')}} :</strong> <span class="ml-2 ">{{$user->email}}</span></p>

                        <p class="text-muted mb-1 font-13"><strong>{{__('Dernière connexion')}} :</strong> <span class="ml-2">{{$login}}</span></p>
                    </div>

                </div> <!-- end card-box -->



            </div> <!-- end col-->
            <div class="col-lg-8 ">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{__("Nombre d'abonnements par catégorie/semaine")}}</h5>
                        <div class="mt-3 chartjs-chart" style="height: 320px;">
                            <canvas id="line-chart-example"></canvas>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <script src="{{asset('assets/libs/chart.js/chart.js.min.js')}}"></script>
{{--    <script>--}}
{{--        ! function ($) {--}}
{{--            "use strict";--}}

{{--            var ChartJs = function () {--}}
{{--                this.$body = $("body"),--}}
{{--                    this.charts = []--}}
{{--            };--}}

{{--            ChartJs.prototype.respChart = function (selector, type, data, options) {--}}
{{--                var draw = Chart.controllers.line.prototype.draw;--}}
{{--                Chart.controllers.line.prototype.draw = function () {--}}
{{--                    draw.apply(this, arguments);--}}
{{--                    var ctx = this.chart.chart.ctx;--}}
{{--                    var _stroke = ctx.stroke;--}}
{{--                    ctx.stroke = function () {--}}
{{--                        ctx.save();--}}
{{--                        ctx.shadowColor = 'rgba(0,0,0,0.01)';--}}
{{--                        ctx.shadowBlur = 20;--}}
{{--                        ctx.shadowOffsetX = 0;--}}
{{--                        ctx.shadowOffsetY = 5;--}}
{{--                        _stroke.apply(this, arguments);--}}
{{--                        ctx.restore();--}}
{{--                    }--}}
{{--                };--}}

{{--                //default config--}}
{{--                Chart.defaults.global.defaultFontColor = "#8391a2";--}}
{{--                Chart.defaults.scale.gridLines.color = "#8391a2";--}}

{{--                // get selector by context--}}
{{--                var ctx = selector.get(0).getContext("2d");--}}
{{--                // pointing parent container to make chart js inherit its width--}}
{{--                var container = $(selector).parent();--}}

{{--                // this function produce the responsive Chart JS--}}
{{--                function generateChart() {--}}
{{--                    // make chart width fit with its container--}}
{{--                    var ww = selector.attr('width', $(container).width());--}}
{{--                    var chart;--}}
{{--                    switch (type) {--}}
{{--                        case 'Line':--}}
{{--                            chart = new Chart(ctx, { type: 'line', data: data, options: options });--}}
{{--                            break;--}}
{{--                        case 'Doughnut':--}}
{{--                            chart = new Chart(ctx, { type: 'doughnut', data: data, options: options });--}}
{{--                            break;--}}
{{--                        case 'Pie':--}}
{{--                            chart = new Chart(ctx, { type: 'pie', data: data, options: options });--}}
{{--                            break;--}}
{{--                        case 'Bar':--}}
{{--                            chart = new Chart(ctx, { type: 'bar', data: data, options: options });--}}
{{--                            break;--}}
{{--                        case 'Radar':--}}
{{--                            chart = new Chart(ctx, { type: 'radar', data: data, options: options });--}}
{{--                            break;--}}
{{--                        case 'PolarArea':--}}
{{--                            chart = new Chart(ctx, { data: data, type: 'polarArea', options: options });--}}
{{--                            break;--}}
{{--                    }--}}
{{--                    return chart;--}}
{{--                };--}}
{{--                // run function - render chart at first load--}}
{{--                return generateChart();--}}
{{--            },--}}
{{--                // init various charts and returns--}}
{{--                ChartJs.prototype.initCharts = function () {--}}
{{--                    var charts = [];--}}
{{--                    if ($('#line-chart-example').length > 0) {--}}
{{--                        var lineChart = {--}}
{{--                            labels: ["{{__("Lun")}}","{{__("Mar")}}", "{{__("Mer")}}", "{{__("Jeu")}}", "{{__("Ven")}}", "{{__("Sam")}}", "{{__("Dim")}}"],--}}
{{--                            datasets: [{--}}
{{--                                label: "{{__('Scolaire')}}",--}}
{{--                                backgroundColor: 'rgba(74, 129, 212, 0.3)',--}}
{{--                                borderColor: '#4a81d4',--}}
{{--                                borderDash: [5, 5],--}}
{{--                                data: [--}}
{{--                                    @foreach($initscolaire as $scolaire)--}}
{{--                                    {{$scolaire}},--}}
{{--                                    @endforeach--}}
{{--                                ]--}}
{{--                            }, {--}}
{{--                                label: "{{__('Civile')}}",--}}
{{--                                fill: true,--}}
{{--                                backgroundColor: 'rgba(212,74,90,0.3)',--}}
{{--                                borderColor: "#f1556c",--}}
{{--                                borderDash: [5, 5],--}}
{{--                                data: [--}}
{{--                                    @foreach($initcivile as $civile)--}}
{{--                                    {{$civile}},--}}
{{--                                    @endforeach--}}
{{--                                ]--}}
{{--                            },{--}}
{{--                                label: "{{__('Sociale')}}",--}}
{{--                                backgroundColor: 'rgba(12,243,0,0.29)',--}}
{{--                                borderColor: '#4ad471',--}}
{{--                                borderDash: [5, 5],--}}
{{--                                data: [--}}
{{--                                    @foreach($initsociale as $sociale)--}}
{{--                                    {{$sociale}},--}}
{{--                                    @endforeach--}}
{{--                                ]--}}
{{--                            }]--}}
{{--                        };--}}

{{--                        var lineOpts = {--}}
{{--                            maintainAspectRatio: false,--}}
{{--                            legend: {--}}
{{--                                display: false--}}
{{--                            },--}}
{{--                            tooltips: {--}}
{{--                                intersect: false--}}
{{--                            },--}}
{{--                            hover: {--}}
{{--                                intersect: true--}}
{{--                            },--}}
{{--                            plugins: {--}}
{{--                                filler: {--}}
{{--                                    propagate: false--}}
{{--                                }--}}
{{--                            },--}}
{{--                            scales: {--}}
{{--                                xAxes: [{--}}
{{--                                    reverse: true,--}}
{{--                                    gridLines: {--}}
{{--                                        color: "rgba(0,0,0,0.05)"--}}
{{--                                    }--}}
{{--                                }],--}}
{{--                                yAxes: [{--}}
{{--                                    ticks: {--}}
{{--                                        stepSize: 20--}}
{{--                                    },--}}
{{--                                    display: true,--}}
{{--                                    borderDash: [5, 5],--}}
{{--                                    gridLines: {--}}
{{--                                        color: "rgba(0,0,0,0)",--}}
{{--                                        fontColor: '#fff'--}}
{{--                                    }--}}
{{--                                }]--}}
{{--                            }--}}
{{--                        };--}}
{{--                        charts.push(this.respChart($("#line-chart-example"), 'Line', lineChart, lineOpts));--}}
{{--                    }--}}


{{--                    return charts;--}}
{{--                },--}}
{{--                //initializing various components and plugins--}}
{{--                ChartJs.prototype.init = function () {--}}
{{--                    var $this = this;--}}
{{--                    // font--}}
{{--                    Chart.defaults.global.defaultFontFamily = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';--}}

{{--                    // init charts--}}
{{--                    $this.charts = this.initCharts();--}}

{{--                    // enable resizing matter--}}
{{--                    $(window).on('resize', function (e) {--}}
{{--                        $.each($this.charts, function (index, chart) {--}}
{{--                            try {--}}
{{--                                chart.destroy();--}}
{{--                            }--}}
{{--                            catch (err) {--}}
{{--                            }--}}
{{--                        });--}}
{{--                        $this.charts = $this.initCharts();--}}
{{--                    });--}}
{{--                },--}}

{{--                //init flotchart--}}
{{--                $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs--}}
{{--        }(window.jQuery),--}}

{{--            //initializing ChartJs--}}
{{--            function ($) {--}}
{{--                "use strict";--}}
{{--                $.ChartJs.init()--}}
{{--            }(window.jQuery);--}}
{{--    </script>--}}
@endsection
