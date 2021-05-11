@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])

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
                    <img src="{{$client->picture ? url('../storage/app/clients/'.$client->picture) : asset('assets/images/user.png')}}" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0">{{$client->name}}</h4>
                    @if($client->name_parent)
                        <p class="text-muted mb-2 font-13"><strong>{{__('Nom et Prénom Parent')}} :</strong><span class="ml-2">{{$client->name_parent}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>{{__('Cin Parent')}} :</strong><span class="ml-2">{{$client->cin_parent}}</span></p>
                    @endif
                    @if($client->cin)
                        <p class="text-muted mb-2 font-13"><strong>{{__('Cin')}} :</strong><span class="ml-2">{{$client->cin}}</span></p>
                    @endif
                    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i>{{__('Informations Générales')}}</h5>
                    <div class="col-6 mx-auto">
{{--                        <h4 class="font-13 text-muted text-uppercase">{{__('Adresse')}} :</h4>--}}
{{--                        <p class="mb-3">--}}
{{--                            {{$address->address}}--}}
{{--                        </p>--}}
                        <h4 class="font-13 text-muted text-uppercase">{{__('Téléphone')}} :</h4>
                        <p class="mb-3">
                            {{$client->phone}}
                        </p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('Date de naissance')}} :</h4>
                        <p class="mb-3"> {{$client->birth}} ({{$client->age}})</p>

                        {{--                                    <h4 class="font-13 text-muted text-uppercase mb-1">Company :</h4>--}}
                        {{--                                    <p class="mb-3">Vine Corporation</p>--}}

                        <h4 class="font-13 text-muted text-uppercase mb-1">{{__('Abonnements')}} :</h4>
                        {{--                                <p class="mb-3"> {{$subscriptions}}</p>--}}



                    </div>
                    <div id="morris-donut-example" style="height: 350px;" class="morris-chart" data-colors="#4fc6e1,#6658dd,#f1556c"></div>

                    <div class="text-center">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> {{(__('Scolaire'))}} {{$scolaire}}</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-info"></i> {{(__('Civile'))}} {{$civile}}</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> {{(__('Sociale'))}} {{$sociale}}</span>
                        </p>
                    </div>
                    <div class="text-left mt-3">
                        {{--                        <h4 class="font-13 text-uppercase">About Me :</h4>--}}
                        {{--                        <p class="text-muted font-13 mb-3">--}}
                        {{--                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the--}}
                        {{--                            1500s, when an unknown printer took a galley of type.--}}
                        {{--                        </p>--}}


{{--                        @if($client->education->last())--}}
{{--                        <p class="text-muted mb-2 font-13"><strong>{{__('Email')}} :</strong> <span class="ml-2 ">{{app()->getLocale()=='fr'?$client->education->institution->name_french:$client->education->institution->name_arab}}</span></p>--}}
{{--                        @endif--}}
{{--                        <p class="text-muted mb-1 font-13"><strong>{{__('Dernière connexion')}} :</strong> <span class="ml-2">{{$login}}</span></p>--}}
                    </div>

                </div> <!-- end card-box -->



            </div> <!-- end col-->
            <div class="col-lg-8 ">
                <div class="card-box" dir="ltr">
{{--                    <h4 class="header-title mb-3">Stacked Bar Chart</h4>--}}
                    <div class="text-center">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-blue"></i> {{__('Scolaire')}}</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-info"></i> {{__('Civile')}}</span>
                            <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-muted"></i> {{__('Sociale')}}</span>
                        </p>
                    </div>
                    <div id="morris-bar-stacked" style="height: 350px;" class="morris-chart" data-colors="#4a81d4,#4fc6e1,#e3eaef"></div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/morris.js06/morris.js06.min.js')}}"></script>
    <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>

    <!-- Page js-->
    <script>
        !function($) {
            "use strict";

            var MorrisCharts = function() {};
                //creates Stacked chart
                MorrisCharts.prototype.createStackedChart  = function(element, data, xkey, ykeys, labels, lineColors) {
                Morris.Bar({
                    element: element,
                    data: data,
                    xkey: xkey,
                    ykeys: ykeys,
                    stacked: true,
                    labels: labels,
                    hideHover: 'auto',
                    dataLabels: false,
                    resize: true, //defaulted to true
                    gridLineColor: 'rgba(65, 80, 95, 0.07)',
                    barColors: lineColors
                });
            },
                //creates Donut chart
                MorrisCharts.prototype.createDonutChart = function(element, data, colors) {
                    Morris.Donut({
                        element: element,
                        data: data,
                        barSize: 0.2,
                        resize: true, //defaulted to true
                        colors: colors,
                        backgroundColor: 'transparent'
                    });
                },

                MorrisCharts.prototype.init = function() {

                    //creating Stacked chart
                    var $stckedData  = [
                        { y: '2007', a: 45, b: 180, c: 100 },
                        { y: '2008', a: 75,  b: 65, c: 80 },
                        { y: '2009', a: 100, b: 90, c: 56 },
                        { y: '2010', a: 75,  b: 65, c: 89 },
                        { y: '2011', a: 100, b: 90, c: 120 },
                        { y: '2012', a: 75,  b: 65, c: 110 },
                        { y: '2013', a: 50,  b: 40, c: 85 },
                        { y: '2014', a: 75,  b: 65, c: 52 },
                        { y: '2015', a: 50,  b: 40, c: 77 },
                        { y: '2016', a: 75,  b: 65, c: 90 },
                        { y: '2017', a: 100, b: 90, c: 130 },
                        { y: '2018', a: 80, b: 65, c: 95 },

                    ];
                    var colors = ['#4a81d4','#4fc6e1','#e3eaef'];
                    var dataColors = $("#morris-bar-stacked").data('colors');
                    if (dataColors) {
                        colors = dataColors.split(",");
                    }
                    this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c'], ["{{__('Scolaire')}}", "{{__('Civile')}}", "{{__('Sociale')}}"], colors);

                    //creating donut chart
                    var $donutData = [
                        {label: "{{(__('Scolaire'))}}", value: {{$scolaire}} },
                        {label: "{{(__('Civile'))}}", value: {{$civile}} },
                        {label: "{{(__('Sociale'))}}", value: {{$sociale}} }
                    ];
                    var colors = ['#4fc6e1','#6658dd', '#f1556c'];
                    var dataColors = $("#morris-donut-example").data('colors');
                    if (dataColors) {
                        colors = dataColors.split(",");
                    }
                    this.createDonutChart('morris-donut-example', $donutData, colors);
                },
                //init
                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
        }(window.jQuery),

//initializing
            function($) {
                "use strict";
                $.MorrisCharts.init();
            }(window.jQuery);
    </script>
@endsection
