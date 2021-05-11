@extends('layouts.horizontal', ['title' => 'Apexcharts'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Rapports')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Rapports')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Liste des Rapports')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="nav nav-pills flex-column navtab-bg nav-pills-tab text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active show py-2" id="custom-v-pills-billing-tab" data-toggle="pill" href="#custom-v-pills-billing" role="tab" aria-controls="custom-v-pills-billing"
                                       aria-selected="true">
                                        <i class="mdi mdi-account-circle d-block font-24"></i>
                                        {{__('liste des abonnements par mois')}}
                                    </a>
                                    <a disabled class="nav-link mt-2 py-2" id="custom-v-pills-shipping-tab" data-toggle="pill" href="#custom-v-pills-shipping" role="tab" aria-controls="custom-v-pills-shipping"
                                       aria-selected="false">
                                        <i class="mdi mdi-truck-fast d-block font-24"></i>
                                        {{__('liste des abonnements par lignes/stations/Km')}}</a>
                                    <a disabled class="nav-link mt-2 py-2" id="custom-v-pills-payment-tab" data-toggle="pill" href="#custom-v-pills-payment" role="tab" aria-controls="custom-v-pills-payment"
                                       aria-selected="false">
                                        <i class="mdi mdi-cash-multiple d-block font-24"></i>
                                        {{__('liste des abonnements par Utilisateur')}}</a>
                                </div>

                            </div> <!-- end col-->
                            <div class="col-lg-9">
                                <div class="tab-content p-3">
                                    <div class="tab-pane fade active show" id="custom-v-pills-billing" role="tabpanel" aria-labelledby="custom-v-pills-billing-tab">
                                        <div>
                                            <h4 class="header-title">Billing Information</h4>

                                            <p class="sub-header">Fill the form below in order to
                                                send you the order's invoice.</p>
                                            <div class="card-widgets">
                                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                                <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                            </div>
                                            <h4 class="header-title mb-0">Stacked Area</h4>

                                            <div id="cardCollpase4" class="collapse pt-3 show" dir="ltr">
                                                <div id="rapport-1" class="apex-charts" data-colors="#6658dd,#f7b84b,#CED4DC"></div>
                                            </div> <!-- collapsed end -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-v-pills-shipping" role="tabpanel" aria-labelledby="custom-v-pills-shipping-tab">
                                        <div>
                                            <h4 class="header-title">Saved Address</h4>

                                            <p class="sub-header">Fill the form below in order to
                                                send you the order's invoice.</p>

                                            <!-- end row-->


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-v-pills-payment" role="tabpanel" aria-labelledby="custom-v-pills-payment-tab">
                                        <div>
                                            <h4 class="header-title">Payment Selection</h4>

                                            <p class="sub-header">Fill the form below in order to
                                                send you the order's invoice.</p>

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row-->

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <!-- Portlet card -->
                <div class="card">
                    <div class="card-body">

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

    <!-- Page js-->
    {{--    <script src="{{asset('assets/js/pages/apexcharts.init.js')}}"></script>--}}
    <script>
        var colors = ['#ff0101','#f7b84b', '#0069f8'];
        // var dataColors = $("#rapport-1").data('colors');
        // if (dataColors) {
        //     colors = dataColors.split(",");
        // }
        var options = {
            chart: {
                height: 380,
                type: 'area',
                stacked: false,
                events: {
                    selection: function (chart, e) {
                        console.log(new Date(e.xaxis.min))
                    }
                },

            },
            colors: colors,
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [2],
                curve: 'smooth'
            },

            series: [
                {
                    name: '{{__('Scolaire')}}',
                    data: [
                        @foreach($scolaireDates as $scoldate => $n)
                        [new Date('{{$scoldate}}').getTime(),parseInt('{{$n}}')],
                        @endforeach
                    ],
                },
                {
                    name: '{{__('Civile')}}',
                    data: [
                            @foreach($civileDates as $scoldate => $n)
                        [new Date('{{$scoldate}}').getTime(),parseInt('{{$n}}')],
                        @endforeach
                    ],
                },

                {
                    name: '{{__('Sociale')}}',
                    data: [
                            @foreach($socialeDates as $scoldate => $n)
                        [new Date('{{$scoldate}}').getTime(),parseInt('{{$n}}')],
                        @endforeach
                    ],
                }
            ],
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.6,
                    opacityTo: 0.8,
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            },
            xaxis: {
                type: 'datetime'
            },
        }

        var chart = new ApexCharts(
            document.querySelector("#rapport-1"),
            options
        );

        chart.render();

        function generateDayWiseTimeSeries(baseval, count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = baseval;
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                series.push([x, y]);
                baseval += 86400000;
                i++;
            }
            console.log(series);
            return series;
        }
    </script>
@endsection
