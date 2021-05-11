@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    {{--    <link href="{{asset('assets/libs/croppie/croppie.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        /*.card{*/
        /*    border: 1px #00000061 solid!important;*/
        /*}*/
        html{
            direction:ltr!important;
        }
        .header-title{
            text-align: center!important;
            font-size: 20px!important;
        }
        .sub-header{
            text-align: center!important;
        }
        .form-control{
            border: 1px solid #636465!important;
        }
        .disableCard{
            pointer-events: none;
        }
    </style>
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Start Content-->
    {{--    <img src="{{asset('default.png')}}" id="picture-scolaire" style="display: none;">--}}
    {{--    <img src="{{asset('default.png')}}" id="picture-civile" style="display: none;">--}}
    {{--    <img src="{{asset('default.png')}}" id="picture-sociale" style="display: none;">--}}
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Abonnements')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer un Abonnements')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer un Abonnements')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            @foreach($categories as $category)
                <div class="col">
                    <div id="{{$category->type}}" data-mode="{{$category->type}}" class=" tortaw card card-pricing"
                         style="border: 3px solid #e5e8eb !important;cursor: pointer;border-radius: 25px;">
                        <div class="card-body text-center ">
                            <p class="card-pricing-plan-name font-weight-bold text-uppercase">{{app()->getLocale()=='fr' ? $category->name_french : $category->name_arab }}</p>
                            <span id="frame-{{$category->name_french}}" class="card-pricing-icon text-primary">
                                    <i class="fe-users"></i>
                                </span>
                            <img id="picture-{{$category->name_french}}" src="{{asset('default.png')}}"  style="width: 150px; height: 150px; border-radius: 26px;"
                                 class="d-none">
                        </div>
                    </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
            @endforeach
        </div>
        <form id="form-scolaire" style="display: none;" class="needs-validation"  novalidate method="POST" action="{{ route('subscriptions.store') }}" enctype="multipart/form-data">
            @csrf
            <input id="client-scolaire" hidden name="client" value="">
            <input id="category" hidden name="type" value="scolaire">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Informations Génerales')}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name">{{ __('Nom et Prénom Abonné') }}<code>*</code></label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror "  id="name-scolaire"  placeholder="{{ __('Nom et Prénom') }}" value="{{old('name')}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="parent_name">{{ __('Nom et Prénom Parent') }}</label>
                                    <input name="parent_name" type="text" class="form-control" id="parent_name-scolaire" @error('parent_name') is-invalid @enderror placeholder="{{ __('Nom et Prénom Parent') }}" value="{{old('parent_name')}}" >
                                    @error('parent_name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="birth">{{ __('Date de naissance') }}<code>*</code></label>
                                    <input name="birth" type="date"   class="form-control datenaiss" id="birth-scolaire" @error('birth') is-invalid @enderror placeholder="{{ __('Date de naissance') }}" value="" required>
                                    @error('birth')old('birth')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="age">{{ __('Age') }}<code>*</code></label>
                                    <input name="age" readonly type="text"   class="form-control" id="age-scolaire" @error('age') is-invalid @enderror placeholder="{{ __('Age') }}" value="" >
                                    <strong id="invalid-age-text"></strong>
                                    @error('age')old('birth')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Type') }}</label>
                                    <select id="type-scolaire" name="typeClient" class="form-control show-tick"  placeholder="{{ __('Type') }}" required>
                                        <option selected disabled >{{__('Choisir le Type')}}</option>
                                        <option  value="eleve">{{__('Eleve')}}</option>
                                        <option  value="etudiant">{{__('Etudiant')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;cursor: pointer;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Informations Supplémentaires')}}</h4>
                            <p class="sub-header">{{__('lieu de résidence')}}</p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Région') }}</label>
                                    <select @error('region')is-invalid @enderror id="region-scolaire" class="form-control selectpicker"  placeholder="{{ __('Région') }}" value="{{old('region')}}" required>
                                        @foreach($regions as $region)
                                            @if(app()->getLocale()=='fr')
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_french}}</option>
                                            @else
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_arab}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="client_municipality">{{ __('Municipalité') }}</label>
                                    <select @error('municipality')is-invalid @enderror id="client_municipality-scolaire" name="client_municipality" class="form-control selectpicker show-tick"  data-style="btn-outline-primary"
                                            placeholder="{{ __('Municipalité') }}" value="{{old('municipality')}}" required>
                                        @foreach($municipalities as $municipality)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_french}}</option>
                                            @else
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="address">{{ __('Adresse Abonné') }}<code>*</code></label>
                                    <input name="address" type="text" class="form-control" id="client_address-scolaire" @error('address') is-invalid @enderror placeholder="{{ __('Adresse Abonné') }}" value="{{old('parent_cin')}}" required>
                                    @error('first_name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="phone">{{ __('Numéro Téléphone Abonné') }}</label>
                                    <input name="phone" type="text" minlength="8" maxlength="8" class="form-control" id="phone-scolaire" @error('phone') is-invalid @enderror placeholder="{{ __('Numéro Téléphone Abonné') }}" value="{{old('phone')}}" autocomplete="false">
                                    @error('phone')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div id="etude-scolaire" class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__("Données d'étude")}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Région') }}</label>
                                    <select @error('region')is-invalid @enderror id="region-scolaire" class="form-control selectpicker show-tick"  placeholder="{{ __('Région') }}" value="{{old('region')}}" required>
                                        @foreach($regions as $region)
                                            @if(app()->getLocale()=='fr')
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_french}}</option>
                                            @else
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Municipalité') }}</label>
                                    <select @error('municipality')is-invalid @enderror id="municipalities-scolaire" class="form-control"  placeholder="{{ __('Municipalité') }}" value="{{old('municipality')}}" required>
                                        @foreach($municipalities as $municipality)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_french}}</option>
                                            @else
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Niveau') }}<code>*</code></label>
                                    <select @error('level')is-invalid @enderror id="levels-scolaire" class="form-control"  placeholder="{{ __('Niveau') }}" value="{{old('level')}}" required>
                                        <option selected></option>
                                        @foreach($levels as $level)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$level->id}}">{{$level->code}}|{{$level->name_french}}</option>
                                            @else
                                                <option value="{{$level->id}}">{{$level->code}}|{{$level->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Classe') }}<code>*</code></label>
                                    <select name="classroom" @error('classroom')is-invalid @enderror id="classrooms-scolaire" class="form-control "  data-style="btn-outline-primary" placeholder="{{ __('Classe') }}" value="{{old('level')}}" required>
                                        {{--                                <option disabled></option>--}}
                                        {{--                                    @foreach($classrooms as $classroom)--}}
                                        {{--                                        <option value="{{$classroom->id}}">{{$classroom->number}}</option>--}}
                                        {{--                                    @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-12">
                                    <label for="center">{{ __('Institut') }}<code>*</code></label>
                                    <select name="institution" @error('institution')is-invalid @enderror id="institut-scolaire" class="form-control"  placeholder="{{ __('Institut') }}" value="{{old('institution')}}" required>
                                        {{--                                    <option >{{ __('Institut') }}</option>--}}
                                        {{--                                    @foreach($institutions as $institution)--}}
                                        {{--                                        <option value="{{$institution->id}}">{{$institution->code}}|{{$institution->name_french}}</option>--}}
                                        {{--                                    @endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Paiement')}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="periods">{{ __('Période Abonnement') }}<code>*</code></label>
                                    <select @error('periods')is-invalid @enderror id="periods-scolaire" name="period" class="form-control"  placeholder="{{ __('Période Abonnement') }}" value="{{old('period')}}" required>
                                        <option value="">{{ __("Chosir la Période d' Abonnement") }}</option>
                                        @foreach($periodsScolaire as $period)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$period->id}}">{{$period->name_french}}</option>
                                            @else
                                                <option value="{{$period->id}}">{{$period->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="category">{{ __('Phase Abonnement') }}<code>*</code></label>
                                    <select @error('phases')is-invalid @enderror id="phases-scolaire" name="phase" class="form-control"  placeholder="{{ __('Phase Abonnement') }}" value="{{old('phase')}}" required>
                                        <option value="">{{ __("Chosir la Période d'Abonnement") }}</option>
                                    </select>
                                    <strong style="color:green" id="date-phase-scolaire"></strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="jumbotron " id="custom_period_sec"
                                         style="padding: 25px;">
                                        <h3 class="sub-title"></h3>
                                        <div class="text-center add-service-conainer" style="padding-bottom: 15px;">
                                            <button type="button" onclick="addService()" class="btn btn-primary">
                                                {{__('Ajouter Ligne')}}</button>
                                        </div>
                                        <div class="services-container">

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">{{ __('prix totale') }}</label>
                                <input name="price" type="text" class="form-control" id="price-scolaire" readonly @error('price') is-invalid @enderror placeholder="{{ __('prix totale') }}" value="{{old('price')}}" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="method">{{ __('Method Payment') }}<code>*</code></label>
                                    <select @error('method')is-invalid @enderror id="method-scolaire" name="method" class="form-control"  placeholder="{{ __('Method Payment') }}" value="{{old('method')}}" required>
                                        @if(app()->getLocale()=='fr')
                                            <option value="1">{{\App\Method::find(1)->name_french}}</option>
                                        @else
                                            <option value="1">{{\App\Method::find(1)->name_arab}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="payment">{{ __('Numéro') }}<code>*</code></label>
                                    <input name="payment" type="text" class="form-control" autocomplete="off" name="payment" id="payment-scolaire" @error('payment') is-invalid @enderror placeholder="{{ __('Numéro') }}" value="{{old('payment')}}" required>
                                    <strong style="color:red" id="invalid-payment-text"></strong>

                                    @error('payment')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="chain">{{ __("Carte reférence") }}<code>*</code></label>
                                <input type="text" class="form-control" name="chain" id="chain-scolaire" autocomplete="off">
                                <strong style="color:red" id="chain-text-scolaire"></strong>
                                @error('chain')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

            </div>
            <!-- end row -->
            <div class="row">
                {{--                <div class="col-lg-6 mx-auto" style="background-color:white;height:300px;width:500px;border:1px solid black;">--}}
                {{--                    <h5 style="text-align: center;"><strong>رقم البطاقة</strong></h5>--}}
                {{--                    <h5 style="text-align: center;"><strong>12234566</strong></h5>--}}
                {{--                    <h5 style="text-align: right;"><strong>&nbsp; الاسم واللقب&nbsp; سيف بن خراط&nbsp;</strong></h5>--}}
                {{--                    <h5 style="text-align: right;"><strong>&nbsp;تاريخ الولادة 22/02/1995</strong></h5>--}}
                {{--                    <h5 style="text-align: right;"><strong>&nbsp;المؤسسة&nbsp;نهج الهند&nbsp;</strong></h5>--}}
                {{--                    <h5 style="text-align: right;"><strong>الثمن&nbsp; 24,500</strong></h5>--}}
                {{--                    <h5 style="text-align: right; padding-left: 30px;"><strong>&nbsp; 01/01/2021 صالحة من&nbsp; 30/09/2020&nbsp; &nbsp; &nbsp;إلى</strong></h5>--}}
                {{--                    <table style="text-align: right;">--}}
                {{--                        <tbody>--}}
                {{--                        <tr style="height: 44.875px;">--}}
                {{--                            <td style="width: 300px; height: 44.875px; text-align: center;">--}}
                {{--                                <h5>وصولاً إلى&nbsp;</h5>--}}
                {{--                            </td>--}}
                {{--                            <td style="width: 462px; height: 44.875px; text-align: center;">--}}
                {{--                                <h5>إنطلاقا من</h5>--}}
                {{--                            </td>--}}
                {{--                        </tr>--}}
                {{--                        <tr style="height: 22px;">--}}
                {{--                            <td style="width: 300px; height: 22px; text-align: center;">--}}
                {{--                                <h5>&nbsp;</h5>--}}
                {{--                            </td>--}}
                {{--                            <td style="width: 462px; height: 22px; text-align: right;">&nbsp;</td>--}}
                {{--                        </tr>--}}
                {{--                        </tbody>--}}
                {{--                    </table>--}}
                {{--                    <h5>سلمت في&nbsp;</h5>--}}
                {{--                </div>--}}
            </div>
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <div class="accordion custom-accordion" id="custom-accordion-one">
                                <div class="card mb-0">
                                    <div class="card-header" id="headingNine">
                                        <h5 class="m-0 position-relative">
                                            <a class="custom-accordion-title text-reset d-block"
                                               data-toggle="collapse" href="#collapseNine"
                                               aria-expanded="true" aria-controls="collapseNine">
                                                {{__('Image Abonné')}} <i
                                                    class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseNine" class="collapse "
                                         aria-labelledby="headingFour"
                                         data-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            <input id="upload-scolaire" class="dropify" onchange="loadFile(event, 'scolaire')" name="picture" type="file" data-plugins="dropify"  />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <button disabled  id="submit-scolaire" type="submit" class="btn btn-block btn-lg btn-primary waves-effect waves-light">{{__('confirmer')}}</button>

        </form>
        <form id="form-civile" style="display: none;" class="needs-validation"  novalidate method="POST" action="{{ route('subscriptions.store') }}" enctype="multipart/form-data">
            @csrf
            <input id="client-civile" hidden name="client" value="">
            <input id="category" hidden name="type" value="civile">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Informations Génerales')}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name">{{ __('Nom et Prénom Abonné') }}<code>*</code></label>
                                    <input name="name" type="text" class="form-control" id="name-civile" @error('name') is-invalid @enderror placeholder="{{ __('Nom et Prénom') }}"  required>
                                    @error('name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="cin">{{ __('Cin Abonné') }}<code>*</code></label>
                                    <input name="cin" type="text" class="form-control" id="cin-civile" @error('cin') is-invalid @enderror placeholder="{{ __('Cin Abonné') }}" value="{{old('cin')}}" maxlength="8">
                                    @error('cin')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="birth">{{ __('Date de naissance') }}<code>*</code></label>
                                    <input name="birth" type="date" class="form-control datenaiss" id="birth-civile" @error('birth') is-invalid @enderror placeholder="{{ __('Date de naissance') }}" value="{{old('birth')}}" required>
                                    @error('birth')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="age">{{ __('Age') }}<code>*</code></label>
                                    <input name="age" readonly type="number"   class="form-control" id="age-civile" @error('age') is-invalid @enderror placeholder="{{ __('Age') }}" value="" >
                                    <strong id="invalid-age-text2"></strong>
                                    @error('age')old('birth')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Informations Supplémentaires')}}</h4>
                            <p class="sub-header">{{__('lieu de résidence')}}</p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Région') }}</label>
                                    <select @error('region')is-invalid @enderror id="region-civile" class="form-control selectpicker"  placeholder="{{ __('Région') }}" value="{{old('region')}}" required>
                                        @foreach($regions as $region)
                                            @if(app()->getLocale()=='fr')
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_french}}</option>
                                            @else
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="client_municipality">{{ __('Municipalité') }}</label>
                                    <select @error('municipality')is-invalid @enderror id="client_municipality-civile" name="client_municipality" class="form-control selectpicker show-tick"  data-style="btn-outline-primary"
                                            placeholder="{{ __('Municipalité') }}" value="{{old('municipality')}}" required>
                                        @foreach($municipalities as $municipality)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_french}}</option>
                                            @else
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="address">{{ __('Adresse Abonné') }}<code>*</code></label>
                                    <input name="address" type="text" class="form-control" id="client_address-civile" @error('address') is-invalid @enderror placeholder="{{ __('Adresse Abonné') }}" value="{{old('parent_cin')}}" required>
                                    @error('first_name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="phone">{{ __('Numéro Téléphone Abonné') }}</label>
                                    <input name="phone" type="text" minlength="8" maxlength="8" class="form-control" id="phone-civile" @error('phone') is-invalid @enderror placeholder="{{ __('Numéro Téléphone Abonné') }}" value="{{old('phone')}}"  autocomplete="false">
                                    @error('phone')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="company">{{ __('Société Abonné') }}</label>
                                    <select id="company-civile" name="company" class="form-control selectpicker show-tick">
                                        <option selected >{{__('Choisir Société')}}</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{app()->getLocale()=='fr' ? $company->name_french : $company->name_arab}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-8 mx-auto">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Paiement')}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="periods">{{ __('Période Abonnement') }}<code>*</code></label>
                                    <select @error('periods')is-invalid @enderror id="periods-civile" name="period" class="form-control"  placeholder="{{ __('Période Abonnement') }}" value="{{old('period')}}" required>
                                        <option value="">{{ __("Chosir la Période d'Abonnement") }}</option>
                                        @foreach($periodsCivile as $period)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$period->id}}">{{$period->name_french}}</option>
                                            @else
                                                <option value="{{$period->id}}">{{$period->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="category">{{ __('Phase Abonnement') }}<code>*</code></label>
                                    <select @error('phases')is-invalid @enderror id="phases-civile" name="phase" class="form-control"  placeholder="{{ __('Phase Abonnement') }}" value="{{old('phase')}}" required>
                                        <option value="">{{ __("Chosir la Période d' Abonnement") }}</option>

                                    </select>
                                    <strong style="color:green" id="date-phase-civile"></strong>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="jumbotron" id="custom_period_sec"
                                         style="padding: 25px;">
                                        <h3 class="sub-title"></h3>
                                        <div class="text-center add-service-conainer" style="padding-bottom: 15px;">
                                            <button type="button" onclick="addService()" class="btn btn-primary">
                                                {{__('Ajouter Ligne')}}</button>
                                        </div>
                                        <div class="services-container">

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">{{ __('prix totale') }}</label>
                                <input name="price" type="text" class="form-control" readonly id="price-civile" @error('price') is-invalid @enderror placeholder="{{ __('prix totale') }}" value="{{old('price')}}" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="method">{{ __('Method Payment') }}<code>*</code></label>
                                    <select @error('method')is-invalid @enderror name="method" id="method-civile" class="form-control"  placeholder="{{ __('Method Payment') }}" value="{{old('method')}}" required>
                                        <option value="method">{{ __("Method Payment") }}</option>
                                        @foreach($methods as $method)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$method->id}}">{{$method->name_french}}</option>
                                            @else
                                                <option value="{{$method->id}}">{{$method->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="validationCustom00">{{ __('Numéro') }}<code>*</code></label>
                                    <input name="payment" autocomplete="off" type="text" class="form-control" id="payment-civile" @error('payment') is-invalid @enderror placeholder="{{ __('Numéro') }}" value="{{old('payment')}}" required>
                                    <strong style="color:red" id="invalid-payment-text2"></strong>
                                    @error('payment')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="chain">{{ __("Carte reférence") }}<code>*</code></label>
                                <input type="text" class="form-control" name="chain" id="chain-civile" autocomplete="false">
                                <strong style="color:red" id="chain-text-civile"></strong>
                                @error('chain')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

            </div>
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <div class="accordion custom-accordion" id="custom-accordion-one">
                                <div class="card mb-0">
                                    <div class="card-header" id="headingNine">
                                        <h5 class="m-0 position-relative">
                                            <a class="custom-accordion-title text-reset d-block"
                                               data-toggle="collapse" href="#collapseNine"
                                               aria-expanded="true" aria-controls="collapseNine">
                                                {{__('Image Abonné')}} <i
                                                    class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseNine" class="collapse "
                                         aria-labelledby="headingFour"
                                         data-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            <input id="upload-civile" class="dropify"  onchange="loadFile(event, 'civile')" name="picture" type="file" data-plugins="dropify"  />
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
            <button disabled id="submit-civile" type="submit" class="btn btn-block btn-lg btn-primary waves-effect waves-light">{{__('confirmer')}}</button>
        </form>
        <form id="form-sociale" style="display: none;" class="needs-validation"  novalidate method="POST" action="{{ route('subscriptions.store') }}" enctype="multipart/form-data">
            @csrf
            <input id="client-sociale" hidden name="client" value="">
            <input id="category" hidden name="type" value="sociale">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Informations Génerales')}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name">{{ __('Nom et Prénom Abonné') }}<code>*</code></label>
                                    <input name="name" type="text" class="form-control" id="name-sociale" @error('name') is-invalid @enderror placeholder="{{ __('Nom et Prénom') }}" value="{{old('name')}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{--                                <div class="form-group mb-3 col-md-6">--}}
                                {{--                                    <label for="cin">{{ __('Cin Abonné') }}</label>--}}
                                {{--                                    <input name="cin" type="text" class="form-control" id="cin" @error('cin') is-invalid @enderror placeholder="{{ __('Cin Abonné') }}" value="{{old('cin')}}" maxlength="8">--}}
                                {{--                                    @error('cin')--}}
                                {{--                                    <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
                                {{--                                        <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="parent_name">{{ __('Nom et Prénom Parent') }}</label>
                                    <input name="parent_name" type="text" class="form-control" id="parent_name-sociale" @error('parent_name') is-invalid @enderror placeholder="{{ __('Nom et Prénom Parent') }}" value="{{old('parent_name')}}" >
                                    @error('parent_name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="parent_cin">{{ __('Cin Parent') }}<code>*</code></label>
                                    <input name="parent_cin" type="text" class="form-control" id="parent_cin-sociale" @error('parent_cin') is-invalid @enderror placeholder="{{ __('Cin Parent') }}" value="{{old('parent_cin')}}" maxlength="8" >
                                    @error('cin')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="birth">{{ __('Date de naissance') }}<code>*</code></label>
                                    <input name="birth" type="date" class="form-control datenaiss" id="birth-sociale" @error('birth') is-invalid @enderror placeholder="{{ __('Date de naissance') }}" value="{{old('birth')}}" required>
                                    @error('birth')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="age">{{ __('Age') }}<code>*</code></label>
                                    <input name="age" readonly type="number"   class="form-control" id="age-sociale" @error('age') is-invalid @enderror placeholder="{{ __('Age') }}" value="" >

                                    @error('age')old('birth')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Type') }}</label>
                                    <select id="type-sociale" name="typeClient" class="form-control "  placeholder="{{ __('Type') }}" required>
                                        <option disabled >{{__('Choisir le Type')}}</option>
                                        <option  value="eleve">{{__('Eleve')}}</option>
                                        <option  value="etudiant">{{__('Etudiant')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Informations Supplémentaires')}}</h4>
                            <p class="sub-header">{{__('lieu de résidence')}}</p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Région') }}</label>
                                    <select @error('region')is-invalid @enderror id="region" class="form-control selectpicker"  placeholder="{{ __('Région') }}" value="{{old('region')}}" required>
                                        @foreach($regions as $region)
                                            @if(app()->getLocale()=='fr')
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_french}}</option>
                                            @else
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="client_municipality">{{ __('Municipalité') }}</label>
                                    <select @error('municipality')is-invalid @enderror id="client_municipality" name="client_municipality" class="form-control selectpicker show-tick"  data-style="btn-outline-primary"
                                            placeholder="{{ __('Municipalité') }}" value="{{old('municipality')}}" required>
                                        @foreach($municipalities as $municipality)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_french}}</option>
                                            @else
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="address">{{ __('Adresse Abonné') }}<code>*</code></label>
                                    <input name="address" type="text" class="form-control" id="client_address" @error('address') is-invalid @enderror placeholder="{{ __('Adresse Abonné') }}" value="{{old('parent_cin')}}" required>
                                    @error('first_name')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="phone">{{ __('Numéro Téléphone Abonné') }}</label>
                                    <input name="phone" type="text" minlength="8" maxlength="8" class="form-control" id="phone-sociale" @error('phone') is-invalid @enderror placeholder="{{ __('Numéro Téléphone Abonné') }}" value="{{old('phone')}}" autocomplete="false">
                                    @error('phone')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div id="etude-sociale" class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__("Données d'étude")}}</h4>
                            <p class="sub-header"></p>

                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Région') }}</label>
                                    <select @error('region')is-invalid @enderror id="region" class="form-control selectpicker show-tick"  placeholder="{{ __('Région') }}" value="{{old('region')}}" required>
                                        @foreach($regions as $region)
                                            @if(app()->getLocale()=='fr')
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_french}}</option>
                                            @else
                                                <option selected value="{{$region->id}}">{{$region->code}}|{{$region->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Municipalité') }}</label>
                                    <select @error('municipality')is-invalid @enderror id="municipalities-sociale" class="form-control"  placeholder="{{ __('Municipalité') }}" value="{{old('municipality')}}" required>
                                        @foreach($municipalities as $municipality)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_french}}</option>
                                            @else
                                                <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Niveau') }}<code>*</code></label>
                                    <select @error('level')is-invalid @enderror id="levels-sociale" class="form-control "  placeholder="{{ __('Niveau') }}" value="{{old('level')}}" required>
                                        <option selected></option>
                                        @foreach($levels as $level)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$level->id}}">{{$level->code}}|{{$level->name_french}}</option>
                                            @else
                                                <option value="{{$level->id}}">{{$level->code}}|{{$level->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="center">{{ __('Classe') }}<code>*</code></label>
                                    <select name="classroom" @error('classroom')is-invalid @enderror id="classrooms-sociale" class="form-control "  data-style="btn-outline-primary" placeholder="{{ __('Classe') }}" value="{{old('level')}}" required>
                                        <option disabled></option>
                                        {{--                                    @foreach($classrooms as $classroom)--}}
                                        {{--                                        <option value="{{$classroom->id}}">{{$classroom->number}}</option>--}}
                                        {{--                                    @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-12">
                                    <label for="center">{{ __('Institut') }}<code>*</code></label>
                                    <select name="institution" @error('institution')is-invalid @enderror id="institut-sociale" class="form-control"  placeholder="{{ __('Institut') }}" value="{{old('institution')}}" required>
                                        <option >{{ __('Institut') }}</option>
                                        {{--                                    @foreach($institutions as $institution)--}}
                                        {{--                                        <option value="{{$institution->id}}">{{$institution->code}}|{{$institution->name_french}}</option>--}}
                                        {{--                                    @endforeach--}}
                                    </select>
                                </div>
                            </div>



                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-lg-6">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Paiement')}}</h4>
                            <p class="sub-header"></p>
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="periods">{{ __('Période Abonnement') }}<code>*</code></label>
                                    <select @error('periods')is-invalid @enderror id="periods-sociale" name="period" class="form-control"  placeholder="{{ __('Période Abonnement') }}" value="{{old('period')}}" required>
                                        <option value="">{{ __("Chosir la Période d' Abonnement") }}</option>
                                        @foreach($periodsSociale as $period)
                                            @if(app()->getLocale()=='fr')
                                                <option value="{{$period->id}}">{{$period->name_french}}</option>
                                            @else
                                                <option value="{{$period->id}}">{{$period->name_arab}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="category">{{ __('Phase Abonnement') }}<code>*</code></label>
                                    <select @error('phases')is-invalid @enderror id="phases-sociale" name="phase" class="form-control"  placeholder="{{ __('Phase Abonnement') }}" value="{{old('phase')}}" required>
                                        <option value="">{{ __("Chosir la Période d' Abonnement") }}</option>

                                    </select>
                                    <strong style="color:green" id="date-phase-sociale"></strong>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="jumbotron" id="custom_period_sec"
                                         style="padding: 25px;">
                                        <h3 class="sub-title"></h3>
                                        <div class="text-center add-service-conainer" style="padding-bottom: 15px;">
                                            <button type="button" onclick="addService()" class="btn btn-primary">
                                                {{__('Ajouter Ligne')}}</button>
                                        </div>
                                        <div class="services-container">

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationCustom00">{{ __('prix totale') }}</label>
                                <input disabled name="price" type="text" class="form-control" id="price-sociale" @error('price') is-invalid @enderror placeholder="{{ __('prix totale') }}" value="{{old('price')}}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="chain">{{ __("Carte reférence") }}<code>*</code></label>
                                <input type="text" class="form-control" name="chain" id="chain-sociale" autocomplete="off">
                                <strong style="color:red" id="chain-text-sociale"></strong>
                                @error('chain')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

            </div>
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card" style="border: 3px solid #e5e8eb !important;border-radius: 25px;">
                        <div class="card-body">
                            <div class="accordion custom-accordion" id="custom-accordion-one">
                                <div class="card mb-0">
                                    <div class="card-header" id="headingNine">
                                        <h5 class="m-0 position-relative">
                                            <a class="custom-accordion-title text-reset d-block"
                                               data-toggle="collapse" href="#collapseNine"
                                               aria-expanded="true" aria-controls="collapseNine">
                                                {{__('Image Abonné')}} <i
                                                    class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseNine" class="collapse "
                                         aria-labelledby="headingFour"
                                         data-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            <input id="upload-sociale" class="dropify" onchange="loadFile(event, 'sociale')" name="picture" type="file" data-plugins="dropify"  />
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
            <button disabled id="submit-sociale" type="submit" class="btn btn-block btn-lg btn-primary waves-effect waves-light">{{__('confirmer')}}</button>
        </form>
    </div> <!-- container -->
    <!-- Right modal content -->
    <div id="right-modal" class="modal fade " data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-scrollable modal-right" style="max-height: fit-content;max-width: inherit">



            <!-- /.modal-content -->
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button id="dismiss" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <button id="reverse-verif" class="btn btn-primary" style="display: none;width: 100%;
                    border-bottom: 1px solid #6658dd !important;">{{__('Retour')}}</button>
                </div>
                <div class="modal-body" id="tobechanged">
                    <div class="card mb-0 mt-3 " id="resultcontainer" style="display: none;">

                    </div> <!-- end card-->
                    <div class="text-center" id="verifcontainer">
                        <h4 class="mt-0">{{__('Vérification')}}</h4>
                        <label id="label" class="mt-0"></label>
                        <input class="form-control mb-3" type="text" id="search-cin" name="cin">
                        <button id="verifbtn" type="button" class="btn btn-primary btn-sm" >{{__('Confirmer')}}</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row" id="simple-dragula" data-plugin="dragula">
        <div class="col-md-4">

        </div> <!-- end col-->
    </div>
@endsection

@section('script')

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    {{--    <script src="{{asset('assets/libs/croppie/croppie.js')}}"></script>--}}
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
    <script>
        if ($('[data-plugins="dropify"]').length > 0) {
            // Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        }
    </script>

    <!-- Page js-->
    {{--    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>--}}
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script >
        $.fn.datepicker.dates['fr'] = {
            days: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            daysShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
            daysMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
            months: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
                'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
            monthsShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
                'Jul','Aou','Sep','Oct','Nov','Dec'],
            today: "Today",
            clear: "Clear",
            format: "mm/dd/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };
        $.fn.datepicker.dates.fr.titleFormat="MM";

    </script>

    <script>
        function addService() {
            var id = $('#form-'+mode).find('.activity_service:last').attr('data-id');
            var count = 1;
            let myoptions = '';
            if (mode == 'scolaire') {
                @if(app()->getLocale()=='fr')
                    @foreach($lines_scolaire as $line)
                    myoptions +=  `<option value="{{$line->id}}">{{$line->num}} | {{$line->stations()->orderBy('order')->first()->name_french.'->'.$line->stations()->orderBy('order','desc')->first()->name_french }}</option>`;
                @endforeach
                    @else
                    @foreach($lines_scolaire as $line)
                    myoptions +=  `<option value="{{$line->id}}">{{$line->num}} | {{$line->stations()->orderBy('order')->first()->name_arab.'->'.$line->stations()->orderBy('order','desc')->first()->name_arab }}</option>`;
                @endforeach
                @endif
            } else if(mode == 'sociale') {
                @if(app()->getLocale()=='fr')
                    @foreach($lines_sociale as $line)
                    myoptions +=  `<option value="{{$line->id}}">{{$line->num}} | {{$line->stations()->orderBy('order')->first()->name_french.'->'.$line->stations()->orderBy('order','desc')->first()->name_french }}</option>`;
                @endforeach
                    @else
                    @foreach($lines_sociale as $line)
                    myoptions +=  `<option value="{{$line->id}}">{{$line->num}} | {{$line->stations()->orderBy('order')->first()->name_arab.'->'.$line->stations()->orderBy('order','desc')->first()->name_arab }}</option>`;
                @endforeach
                @endif
            } else {
                @if(app()->getLocale()=='fr')
                    @foreach($lines_civile as $line)
                    myoptions +=  `<option value="{{$line->id}}">{{$line->num}} | {{$line->stations()->orderBy('order')->first()->name_french.'->'.$line->stations()->orderBy('order','desc')->first()->name_french }}</option>`;
                @endforeach
                    @else
                    @foreach($lines_civile as $line)
                    myoptions +=  `<option value="{{$line->id}}">{{$line->num}} | {{$line->stations()->orderBy('order')->first()->name_arab.'->'.$line->stations()->orderBy('order','desc')->first()->name_arab }}</option>`;
                @endforeach
                @endif


            }
            if(id) {
                id = id.split('-')[1];
                count = parseInt(id) + 1;
                $('#form-'+mode).find('.activity_service:last').after(`<div data-id="hs-` + count + `" class="activity_service"> <div class="form-row"> <div class="col-md-2"> <div class="form-group"> <label for="activity_type_service_` + count + `">{{__('ligne')}}</label> <select required class="line-scolaire form-control form-control-sm selectpicker" data-live-search="true"  name="lignes[` + count + `][id]" id="activity_type_service_` + count + `" data-id="` + count + `"> <option>{{ __("Chosir la Période d'Abonnement") }}</option> `+ myoptions +` </select> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="activity_name_service_` + count + `">{{__('debut')}}</label> <input required type="text" class="form-control form-control-sm servicename" name="lignes[` + count + `][depart]" id="activity_name_service_` + count + `" data-id="` + count + `"> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="activity_service_id_` + count + `">{{__('fin')}}</label> <input type="text" class="form-control form-control-sm identifiant" name="lignes[` + count + `][arrive]" id="activity_service_id_` + count + `" data-id="` + count + `"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="activity_price_service_` + count + `">{{__('prix')}}</label> <input required min="1" type="text" class="form-control form-control-sm" name="lignes[` + count + `][prix]" id="activity_price_service_` + count + `"> </div> </div> <div class="col-md-1" style=" margin-top: 37px; font-size: 25px; "> <a style="cursor:pointer;" class="text-center" onclick="deleteService(` + count + `)"><i class="fa fa-trash"></i></a> </div> </div>`);
            } else {
                $('#form-'+mode).find('.services-container').append(`<div data-id="hs-` + count + `" class="activity_service"> <div class="form-row"> <div class="col-md-2"> <div class="form-group"> <label for="activity_type_service_` + count + `">{{__('ligne')}}</label> <select required class="line-scolaire form-control form-control-sm selectpicker" data-live-search="true" name="lignes[` + count + `][id]" id="activity_type_service_` + count + `" data-id="` + count + `"> <option>{{ __("Chosir la Période d'Abonnement") }}</option> `+ myoptions +` </select> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="activity_name_service_` + count + `">{{__('debut')}}</label> <input required type="text" class="form-control form-control-sm servicename" name="lignes[` + count + `][depart]" id="activity_name_service_` + count + `" data-id="` + count + `"> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="activity_service_id_` + count + `">{{__('fin')}}</label> <input type="text" class="form-control form-control-sm identifiant" name="lignes[` + count + `][arrive]" id="activity_service_id_` + count + `" data-id="` + count + `"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="activity_price_service_` + count + `">{{__('prix')}}</label> <input required min="1" type="text" class="form-control form-control-sm" name="lignes[` + count + `][prix]" id="activity_price_service_` + count + `"> </div> </div> <div class="col-md-1" style=" margin-top: 37px; font-size: 25px; "> <a style="cursor:pointer;" class="text-center" onclick="deleteService(` + count + `)"><i class="fa fa-trash"></i></a> </div> </div>`);
            }
            $('.selectpicker').selectpicker();
            verifIfCanSubmit();
        }

        //Delete Service
        function deleteService(el) {
            $('div[data-id="hs-' + el + '"]').remove();
            calculatePrice();
            verifIfCanSubmit();
        }
    </script>
    <script>
        $('.add').click(function () {
            $('.test').append('<div class="form-row"> <div class="form-group mb-3 col-md-3"> <label for="line">{{ __('Ligne') }}</label> <select id="line-scolaire" name="line" class="line-scolaire form-control"  placeholder="{{ __('ligne Abonnement') }}" value="{{old('line')}}" required> <option >{{ __("Chosir la Période d' Abonnement") }}</option> @foreach($lines as $line) <option value="{{$line->id}}">{{$line->num}}</option> @endforeach </select> </div> <div class="form-group mb-3 col-md-3"> <label for="category">{{ __('depart') }}</label> <input type="text" class="form-control depart-scolaire" id="depart-scolaire" disabled value=""> </div> <div class="form-group mb-3 col-md-3"> <label for="category">{{ __('arrivée') }}</label> <input type="text" class="form-control arrivée-scolaire" id="arrivée-scolaire" disabled value=""> </div> <div class="form-group mb-3 col-md-2"> <label for="category">{{ __('prix') }}</label> <input type="text" class="form-control prix-scolaire" id="prix-scolaire" disabled value=""> </div> <div class="form-group mb-3 col-md-1"> <button type="button" class="add btn btn-success waves-effect waves-light"><i class="mdi mdi-plus"></i></button> </div> </div>');
        });
    </script>

    <script>
        $('.date').datepicker({
            format: 'dd-mm-yy',
            autoclose: true,
            language: 'fr',
            startView: 1,
            maxViewMode: "months",
            orientation: "top left",
        })
    </script>
    <script>
        // var $s;
        $('#dismiss').on('click',function () {
            $('.needs-validation').hide();
            // $('#frame'+'-'+mode).removeClass('d-none');
            // $('#picture'+'-'+mode).addClass('d-none');
        })
        $('.select2').select2();
        $('.card-pricing').click(function () {
            let form=$(this).attr('id');
            $('.card-pricing').removeClass('card-pricing-recommended');
            $('.needs-validation').hide();
            // $('.card-pricing-icon').removeClass('text-white');
            $(this).addClass('card-pricing-recommended');
            // $(this).addClass('card-pricing-icon');
            // $('').attr('value',$(this).attr('id'));
            $('#form-'+form).show();
            // $s=$(this).attr('id');
            let cat = $(this).attr('id');
            $("#levels-"+cat).on('change', function () {

                $('#classrooms-'+cat).html('');

                $.ajax({
                    url: "{{route('api.classbylevel')}}" + "/" + $('#levels-'+cat).val(),
                    method: "get",
                    success: function (classrooms) {
                        httt = '<option disabled selected></option>';
                        $.each(classrooms, function (i) {

                            httt += '<option value="' + classrooms[i].id + '">' + classrooms[i].number + '</option> ';
                        });
                        $('#classrooms-'+cat).html(httt);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                $('#institut-'+cat).html('');

                $.ajax({
                    url: "{{route('api.instbymunlev')}}" + "/" + $('#municipalities-'+cat).val()+ "/" + $('#levels-'+cat).val(),
                    method: "get",
                    success: function (institut) {
                        httt = '<option disabled selected></option>';
                        $.each(institut, function (i) {
                            @if(app()->getLocale()=='fr')
                                httt += '<option value="' + institut[i].id + '">' + institut[i].name_french + '</option> ';
                            @else
                                httt += '<option value="' + institut[i].id + '">' + institut[i].name_arab + '</option> ';
                            @endif
                        });
                        $('#institut-'+cat).html(httt);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            $('#municipalities-'+cat).on('change', function () {

                $('#institut-'+cat).html('');

                $.ajax({
                    url: "{{route('api.instbymunlev')}}" + "/" + $('#municipalities-'+cat).val()+ "/" + $('#levels-'+cat).val(),
                    method: "get",
                    success: function (institut) {
                        $('#institut-'+cat).html('<option disabled selected></option>') ;
                        $.each(institut, function (i) {
                            @if(app()->getLocale()=='fr')
                            $('#institut-'+cat).append('<option value="' + institut[i].id + '">' + institut[i].name_french+ '</option> ') ;
                            @else
                            $('#institut-'+cat).append('<option value="' + institut[i].id + '">' + institut[i].name_arab+ '</option> ') ;
                            @endif

                        });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            $('#periods-'+cat).on('change', function () {
                $('#phases-'+cat).html('');

                $.ajax({
                    url: "{{route('api.phasebyperiod')}}" + "/" + $('#periods-'+cat).val(),
                    method: "get",
                    success: function (phases) {
                        let httt = '<option disabled selected></option>';
                        $.each(phases, function (i,v) {
                            @if(app()->getLocale()=='fr')
                                httt += '<option data-date="'+v.date_desc+'" value="' + v.id + '">' + v.name_french+ ' </option> ';
                            @else
                                httt += '<option data-date="'+v.date_desc+'" value="' + v.id + '">' + v.name_arab+ ' </option> ';
                            @endif
                        });
                        $('#phases-'+cat).html(httt);
                        $('#date-phase-'+cat).text($('#phases-'+cat+' option:selected').attr('data-date'));
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
            $('body').on('change','select[name^="lignes"]', function () {
                let myindex = $(this).attr('id').split('_')[3];
                $.ajax({
                    url: "{{route('api.getprice')}}" + "/" + $(this).val()+"/" + mode,
                    method: "get",
                    success: function (price) {
                        $('#activity_name_service_' + myindex).val(price.depart.name_french);
                        $('#activity_service_id_'+ myindex).val(price.arrivée.name_french);

                        $('#activity_price_service_'+myindex).val(price.price);
                        calculatePrice();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });

        $('body').on('click','#close-all',function () {
            $('form[id^="form"]').hide();
            $('#right-modal').modal('hide');
        });

    </script>
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>

    </script>
    <!-- Page js-->
    <script>
        // $('#right-modal').modal({
        //     backdrop: 'static',
        //     keyboard: false
        // });
        // function readFile(input) {
        //     $('#picture-'+mode).attr('src',URL.createObjectURL(input.files[0]));
        //
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //
        //         reader.onload = function(e) {
        //             $("#upload-"+mode).croppie("bind", {
        //                 url: e.target.result
        //             });
        //
        //         };
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }


        //Ajax
        $('.tortaw').click(function () {
            tofill = $('#etude-' + mode);
            let oldmode = mode;
            mode = $(this).attr('data-mode');

            $('#frame'+'-'+oldmode).removeClass('d-none');
            $('#picture'+'-'+oldmode).addClass('d-none');

            switch (mode) {
                case "scolaire":
                    @if(app()->getLocale()=='fr')
                    $('#label').text('nom');
                    @else
                    $('#label').text('الاسم');
                    @endif

                        break;
                case "sociale":
                    @if(app()->getLocale()=='fr')
                    $('#label').text('cin parent');
                    @else
                    $('#label').text('ر.ب.ت الولي');
                    @endif
                        break;
                case "civile":
                    @if(app()->getLocale()=='fr')
                    $('#label').text('cin');
                    @else
                    $('#label').text('ر.ب.ت');
                    @endif
                        break;
            }
            $('#resultcontainer').html('');
            $('#resultcontainer').hide();
            $('#search-cin').val('');
            $('#verifcontainer').show();
            $('#right-modal').modal('show');
            $(mode).addClass('disableCard');
        });

        $('#verifbtn').on('click',function() {
            $.ajax({
                url: '{{route('ajax.verifcin')}}',
                data: {
                    cin: $('#search-cin').val(),
                    mode:mode,
                    _token: '{{csrf_token()}}'
                },
                method: 'POST',
                success: function(res) {
                    if (res.success) {
                        $('#verifcontainer').hide();
                        $('#resultcontainer').html(res.card);
                        $('#resultcontainer').fadeIn();
                        $('#reverse-verif').fadeIn();
                    } else {
                        alert('Non Trouvé');
                    }
                }
            });
        });

        $('body').on('click','#reverse-verif',function() {
            $('#resultcontainer').html('');
            $('#resultcontainer').hide();
            $('#search-cin').val('');
            $('#verifcontainer').show();
            $('#reverse-verif').hide();
        });

        $('#phases-civile').change(function () {
            $('#date-phase-civile').text($('#phases-civile option:selected').attr('data-date'));
        })
        $('#phases-scolaire').change(function () {
            $('#date-phase-scolaire').text($('#phases-scolaire option:selected').attr('data-date'));
        })
        $('#phases-sociale').change(function () {
            $('#date-phase-sociale').text($('#phases-sociale option:selected').attr('data-date'));
        })

        $('body').on('keyup','#chain-scolaire',function() {
            $.ajax({
                url: '{{route('ajax.verifref')}}' + '/' + $(this).val(),
                method: 'get',
                success: function (res) {
                    if (res.correct === 1) {
                        $('#chain-' + mode).removeClass('is-invalid');
                        $('#chain-' + mode).attr('data-valid','true');
                        $('#chain-text-scolaire').css('color','green');
                        $('#chain-text-scolaire').text(res.message);
                    } else {
                        $('#chain-' + mode).addClass('is-invalid');
                        $('#chain-' + mode).attr('data-valid','false');
                        $('#chain-text-scolaire').css('color','red');
                        $('#chain-text-scolaire').text(res.message);
                    }
                    verifIfCanSubmit();
                }
            })
        });
        $('body').on('keyup','#chain-civile',function() {
            $.ajax({
                url: '{{route('ajax.verifref')}}' + '/' + $(this).val(),
                method: 'get',
                success: function (res) {
                    if (res.correct === 1) {
                        $('#chain-' + mode).removeClass('is-invalid');
                        $('#chain-' + mode).attr('data-valid','true');
                        $('#chain-text-civile').css('color','green');
                        $('#chain-text-civile').text(res.message);
                    } else {
                        $('#chain-' + mode).addClass('is-invalid');
                        $('#chain-' + mode).attr('data-valid','false');
                        $('#chain-text-civile').css('color','red');
                        $('#chain-text-civile').text(res.message);
                    }
                    verifIfCanSubmit();
                }
            })
        });
        $('body').on('keyup','#chain-sociale',function() {
            $.ajax({
                url: '{{route('ajax.verifref')}}' + '/' + $(this).val(),
                method: 'get',
                success: function (res) {
                    if (res.correct === 1) {
                        $('#chain-' + mode).removeClass('is-invalid');
                        $('#chain-' + mode).attr('data-valid','true');
                        $('#chain-text-sociale').css('color','green');
                        $('#chain-text-sociale').text(res.message);
                    } else {
                        $('#chain-' + mode).addClass('is-invalid');
                        $('#chain-' + mode).attr('data-valid','false');
                        $('#chain-text-sociale').css('color','red');
                        $('#chain-text-sociale').text(res.message);
                    }
                    verifIfCanSubmit();
                }
            })
        });

        $('body').on('keyup','#payment-scolaire',function() {
            $.ajax({
                url: '{{route('ajax.verifpayment')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    method_id: $('#method-'+mode).val(),
                    payment: $('#payment-'+mode).val(),
                },
                success: function (res) {
                    if (res.is_invalid) {
                        $('#payment-' + mode).removeClass('is-invalid');
                        $('#payment-' + mode).attr('data-valid','true');
                        $('#invalid-payment-text').css('color','green');
                        $('#invalid-payment-text').text(res.message);
                    } else if (!res.is_invalid) {
                        $('#payment-' + mode).addClass('is-invalid');
                        $('#payment-' + mode).attr('data-valid','false');
                        $('#invalid-payment-text').css('color','red');
                        $('#invalid-payment-text').text(res.message);
                    }
                    verifIfCanSubmit();
                }
            })
        });
        $('body').on('keyup','#payment-civile',function() {
            $.ajax({
                url: '{{route('ajax.verifpayment')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    method_id: $('#method-'+mode).val(),
                    payment: $('#payment-'+mode).val(),
                },
                success: function (res) {
                    if (res.is_invalid) {
                        $('#payment-' + mode).removeClass('is-invalid');
                        $('#payment-' + mode).attr('data-valid','true');
                        $('#invalid-payment-text2').css('color','green');
                        $('#invalid-payment-text2').text(res.message);
                    } else if (!res.is_invalid) {
                        $('#payment-' + mode).addClass('is-invalid');
                        $('#payment-' + mode).attr('data-valid','false');
                        $('#invalid-payment-text2').css('color','red');
                        $('#invalid-payment-text2').text(res.message);
                    }
                    verifIfCanSubmit();
                }
            })
        });

        function fill(subscription) {
            subscription = JSON.parse(subscription);
            console.log(subscription);
            switch (mode) {
                case "scolaire":

                    //informations génrales
                    $('#client'+'-'+mode).val(subscription.client_id);
                    $('#name'+'-'+mode).val(subscription.client.name);
                    $('#cin'+'-'+mode).val(subscription.client.cin);
                    $('#parent_name'+'-'+mode).val(subscription.client.parent_name);
                    $('#parent_cin'+'-'+mode).val(subscription.client.parent_cin);
                    $('#birth'+'-'+mode).val(subscription.client.birth);
                    $('#age'+'-'+mode).val(getAge(subscription.client.birth));
                    $('#phone'+'-'+mode).val(subscription.client.phone);


                    //informations supp
                    $('#client_municipality'+'-'+mode).val(subscription.client.address[0].municipality_id).change();//
                    $('#client_address'+'-'+mode).val(subscription.client.address[0].address);
                    $('#type-scolaire'+'-'+mode).val(subscription.type);
                    console.log(subscription.type);
                    //donnes d etude
                    if(subscription.type=="etudiant"){
                        $('#etude-' + mode).hide();
                        $('#region' + mode).removeAttr('required');
                        $('#municipalities' + mode).removeAttr('required');
                        $('#levels' + mode).removeAttr('required');
                        $('#classrooms' + mode).removeAttr('required');
                        $('#institut' + mode).removeAttr('required');
                    }
                        if(subscription.education){
                    $('#municipalities'+'-'+mode).val(subscription.education.institution.municipality.id).change();
                    $('#levels'+'-'+mode).val(subscription.education.institution.level_id).change();
                    setTimeout(function () {
                        $('#classrooms'+'-'+mode).val(subscription.education.classroom_id).change();
                        // $('#classrooms'+'-'+mode).trigger('change');
                        $('#institut'+'-'+mode).val(subscription.education.institution_id).change();
                    },2000);}


                    //paiement
                    $('#periods'+'-'+mode).val(subscription.period.id).change();
                    $('#phases'+'-'+mode).val(subscription.phase_id);
                    $('#price'+'-'+mode).val(subscription.price);


                    fillLignes(subscription.line)
                    // $('#line'+'-'+mode).val(subscription.line_id);
                    // $('#method'+'-'+mode).val(subscription.payment.method.id);
                    $('#frame'+'-'+mode).addClass('d-none');
                    $("#picture-scolaire").removeAttr("class");
                    if(subscription.client.picture)
                    {
                        $("#picture-scolaire").attr('src',"{{asset('storage/clients/')}}"+'/'+subscription.client.picture);
                        var imagenUrl = "{{asset('storage/clients/')}}"+'/'+subscription.client.picture;
                        var drEvent = $('[data-plugins="dropify"]').dropify({
                            defaultFile: imagenUrl ,
                        });
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = imagenUrl;
                        drEvent.destroy();
                        drEvent.init();

                    }
                    break;
                case "civile":
                    //informations génrales
                    $('#name'+'-'+mode).val(subscription.client.name);
                    $('#cin'+'-'+mode).val(subscription.client.cin);
                    // $('#parent_name'+'-'+mode).val(subscription.client.parent_name);
                    // $('#parent_cin'+'-'+mode).val(subscription.client.parent_cin);
                    $('#birth'+'-'+mode).val(subscription.client.birth);
                    $('#age'+'-'+mode).val(getAge(subscription.client.birth));

                    //informations supp
                    if(subscription.company) {
                        $('#company' + '-' + mode).val(subscription.client.company_id).change();//
                    }
                    $('#client_municipality'+'-'+mode).val(subscription.client.address[0].municipality_id).change();//
                    $('#client_address'+'-'+mode).val(subscription.client.address[0].address);
                    $('#phone'+'-'+mode).val(subscription.client.phone);
                    $('#frame'+'-'+mode).addClass('d-none');
                    $("#picture-civile").removeAttr("class");
                    if(subscription.client.picture)
                    {
                        $("#picture-civile").attr('src',"{{asset('storage/clients/')}}"+'/'+subscription.client.picture);
                        var imagenUrl = "{{asset('storage/clients/')}}"+'/'+subscription.client.picture;
                        var drEvent = $('[data-plugins="dropify"]').dropify({
                            defaultFile: imagenUrl ,
                        });
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = imagenUrl;
                        drEvent.destroy();
                        drEvent.init();
                    }
                    break;
                case "sociale":
                    //informations génrales
                    $('#name'+'-'+mode).val(subscription.name);
                    $('#cin'+'-'+mode).val(subscription.cin);
                    $('#parent_name'+'-'+mode).val(subscription.parent_name);
                    $('#parent_cin'+'-'+mode).val(subscription.parent_cin);
                    $('#birth'+'-'+mode).val(subscription.birth);
                    $('#age'+'-'+mode).val(getAge(subscription.birth));
                    $('#phone'+'-'+mode).val(subscription.phone);
                    if(subscription.address){
                        //informations supp
                        $('#client_municipality'+'-'+mode).val(subscription.address[0].municipality_id).change();//
                        $('#client_address'+'-'+mode).val(subscription.address[0].address);
                    }
                    if(subscription.type=="etudiant"){
                        $('#etude-' + mode).hide();
                        $('#region' + mode).removeAttr('required');
                        $('#municipalities' + mode).removeAttr('required');
                        $('#levels' + mode).removeAttr('required');
                        $('#classrooms' + mode).removeAttr('required');
                        $('#institut' + mode).removeAttr('required');
                    }
                    if(subscription.education){
                        //donnes d etude
                        $('#municipalities'+'-'+mode).val(subscription.education.institution.municipality.id).change();
                        $('#levels'+'-'+mode).val(subscription.education.institution.level_id).change();
                        setTimeout(function () {
                            $('#classrooms'+'-'+mode).val(subscription.education.classroom_id).change();
                            // $('#classrooms'+'-'+mode).trigger('change');
                            $('#institut'+'-'+mode).val(subscription.education.institution_id).change();
                        },2000);}
                    fillLignes(subscription.line)
                    // $('#line'+'-'+mode).val(subscription.line_id);
                    // $('#method'+'-'+mode).val(subscription.payment.method.id);
                    $('#frame'+'-'+mode).addClass('d-none');
                    $("#picture-sociale").removeAttr("class");
                    if(subscription.picture)
                    {
                        $("#picture-sociale").attr('src',"{{asset('storage/clients/')}}"+'/'+subscription.picture);
                        var imagenUrl = "{{asset('storage/clients/')}}"+'/'+subscription.picture;
                        var drEvent = $('[data-plugins="dropify"]').dropify({
                            defaultFile: imagenUrl ,
                        });
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = imagenUrl;
                        drEvent.destroy();
                        drEvent.init();
                    }
                    break;
            }
            $('#right-modal').modal('hide');
        }



    </script>
    <script>
        function fillLignes(lignes) {
            let html = '';
            let ids = [];
            $('.services-container').html('');
            $.each(lignes, function (count,v) {
                ids.push(
                    {
                        ligne: lignes[count].id,
                        count: count
                    }
                );
                html += `<div data-id="hs-` + count + `" class="activity_service">
                    <div class="form-row">
                    <div class="col-md-2">
                    <div class="form-group">
                    <label for="activity_type_service_` + count + `">{{__('ligne')}}</label>
                    <select required class="line-scolaire form-control form-control-sm selectpicker" name="lignes[` + count + `][id]" id="activity_type_service_` + count + `" data-id="` + count + `">
                    <option>{{ __("Chosir la Période d'Abonnement") }}</option>
                    @foreach($lines as $line)
                <option value="{{$line->id}}">{{$line->num}}</option>
                    @endforeach
                </select>
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group"> <label for="activity_name_service_` + count + `">{{__('debut')}}</label> <input required type="text" class="form-control form-control-sm servicename" name="lignes[` + count + `][depart]" id="activity_name_service_` + count + `" data-id="` + count + `"> </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> <label for="activity_service_id_` + count + `">{{__('fin')}}</label> <input type="text" class="form-control form-control-sm identifiant" name="lignes[` + count + `][arrive]" id="activity_service_id_` + count + `" data-id="` + count + `"> </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group"> <label for="activity_price_service_` + count + `">{{__('prix')}}</label> <input required min="1" type="text" class="form-control form-control-sm" name="lignes[` + count + `][prix]" id="activity_price_service_` + count + `"> </div>
                </div>
                <div class="col-md-1" style=" margin-top: 37px; font-size: 25px; "> <a style="cursor:pointer;" class="text-center" onclick="deleteService(` + count + `)"><i class="fa fa-trash"></i></a>
                </div>
                </div>`;

            });
            $('.services-container').html(html);
            $('.selectpicker').selectpicker();
            $.each(ids,function (i) {
                $('#activity_type_service_' + ids[i].count).val(ids[i].ligne).change();
            })
        }

        function useCin(cin = null) {
            if (!!cin) {
                $("input[type=text], textarea").val("");
                $("input[type=date]").val("");
                $("input[type=number]").val("");
                switch (mode) {
                    case "scolaire":
                        $('#name-scolaire').val(cin);
                        $('#name-scolaire').attr('readonly', true);
                        break;
                    case "civile":
                        $('#cin-civile').val(cin);
                        $('#cin-civile').attr('readonly', true);
                        break;
                    case "sociale":
                        $('#parent_cin-sociale').val(cin);
                        $('#parent_cin-sociale').attr('readonly', true);
                        $('#parent_name-sociale').attr('readonly', true);
                        break;
                }
            }
            $('#right-modal').modal('hide');
        }
    </script>
    <script>
        function getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (mode == "scolaire" ) {

                $.ajax({
                    url: '{{route('ajax.verifage')}}',
                    method:'POST',
                    data: {
                        birth_date: dateString,
                        _token:'{{csrf_token()}}'
                    },
                    success (res) {
                        if (res.is_valid) {
                            $('#age-' + mode).removeClass('is-invalid');
                            $('#age-' + mode).attr('data-valid','true');
                            $('#invalid-age-text').css('color','green');
                            $('#invalid-age-text').text('{{__("age valide")}}')
                        } else {
                            $('#age-' + mode).addClass('is-invalid');
                            $('#age-' + mode).attr('data-valid','false');
                            $('#invalid-age-text').css('color','red');
                            $('#invalid-age-text').text('{{__("age invalide")}}')
                        }
                        verifIfCanSubmit();
                    },
                })
            }
            if (mode == "sociale" ) {

                $.ajax({
                    url: '{{route('ajax.verifage')}}',
                    method:'POST',
                    data: {
                        birth_date: dateString,
                        _token:'{{csrf_token()}}'
                    },
                    success (res) {
                        if (res.is_valid) {
                            $('#age-' + mode).removeClass('is-invalid');
                            $('#age-' + mode).attr('data-valid','true');
                            $('#invalid-age-text2').css('color','green');
                            $('#invalid-age-text2').text('{{__("age valide")}}')
                        } else {
                            $('#age-' + mode).addClass('is-invalid');
                            $('#age-' + mode).attr('data-valid','false');
                            $('#invalid-age-text2').css('color','red');
                            $('#invalid-age-text2').text('{{__("age invalide")}}')
                        }
                        verifIfCanSubmit();
                    },
                })
            }
            if (mode == "civile") {

                $.ajax({
                    url: '{{route('ajax.verifagecivile')}}',
                    method:'POST',
                    data: {
                        birth_date: dateString,
                        _token:'{{csrf_token()}}'
                    },
                    success (res) {
                        if (res.is_valid) {
                            $('#age-' + mode).removeClass('is-invalid');
                            $('#age-' + mode).attr('data-valid','true');
                            $('#invalid-age-text2').css('color','green');
                            $('#invalid-age-text2').text('{{__("age valide")}}')
                        } else {
                            $('#age-' + mode).addClass('is-invalid');
                            $('#age-' + mode).attr('data-valid','false');
                            $('#invalid-age-text2').css('color','red');
                            $('#invalid-age-text2').text('{{__("age invalide")}}')
                        }
                        verifIfCanSubmit();
                    },
                })
            }
            return age;
        }
        $('body').on('click','.btn-trigger-verif',function () {
            verifIfCanSubmit();
        });

        $('body').on('change','#upload-scolaire', function () {
            let input = document.getElementById('upload-scolaire');
            $('#picture-scolaire').attr('src',URL.createObjectURL(input.files[0]));
            $('#frame-scolaire').attr('src',URL.createObjectURL(input.files[0]));
        });
        $('body').on('change','#upload-civile', function () {
            let input = document.getElementById('upload-civile');
            $('#picture-civile').attr('src',URL.createObjectURL(input.files[0]));
            $('#frame-civile').attr('src',URL.createObjectURL(input.files[0]));
        });
        $('body').on('change','#upload-sociale', function () {
            let input = document.getElementById('upload-sociale');
            $('#picture-sociale').attr('src',URL.createObjectURL(input.files[0]));
            $('#frame-sociale').attr('src',URL.createObjectURL(input.files[0]));
        });

        $('body').on('change','#type-scolaire', function () {
            console.log('changed');
            if ($(this).val() == 'etudiant') {
                $('#etude-' + mode).hide();
                $('#region-scolaire').removeAttr('required');
                $('#municipalities-scolaire').removeAttr('required');
                $('#levels-scolaire').removeAttr('required');
                $('#classrooms-scolaire').removeAttr('required');
                $('#institut-scolaire').removeAttr('required');
            } else {
                $('#etude-' + mode).show();
                $('#region-scolaire').attr('required','required');
                $('#municipalities-scolaire').attr('required','required');
                $('#levels-scolaire').attr('required','required');
                $('#classrooms-scolaire').attr('required','required');
                $('#institut-scolaire').attr('required','required');
            }
        });
        $('body').on('change','#type-sociale', function () {
            console.log('changed');
            if ($(this).val() == 'etudiant') {
                $('#etude-' + mode).hide();
            } else {
                $('#etude-' + mode).show();
            }
        });

        $('.datenaiss').on('change',function () {
            var age=getAge($(this).val());
            $("#age-" + mode).val(age);
            console.log(age);
            //Type Select Box
            if (age > 25) {
                $('#type-' + mode).html(`<option value="etudiant">{{__('Etudiant')}}</option>`);
                $('#etude-' + mode).hide();
            } else if ( age <= 25 ) {
                $('#type-' + mode).html(`<option value="eleve">{{__('Eleve')}}</option><option value="etudiant">{{__('Etudiant')}}</option>`);
                $('#etude-' + mode).show();
            }
            // $('#type-' + mode).selectpicker();
        });
        // $('.calculate').on('change',function () {
        //     var price=calculatePrice();
        //     $("#price-"+mode).val(price);
        // })


        function calculatePrice() {
            var result=0;
            $("[name*='[prix]']").each(function () {
                result +=Number($(this).val());
            })
            $("#price-"+mode).val(result);
        }

        function verifIfCanSubmit() {
            let pass =true;
            let message = '';
            switch (mode) {
                case "scolaire":
                    if ( ( $('#age-' + mode).attr('data-valid') == null ) || ( $('#age-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('age invalide')}}, "
                    }

                    if ( ( $('#chain-' + mode).attr('data-valid') == null ) || ( $('#chain-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('Reference invalide')}}, "
                    }
                    if ( ( $('#payment-' + mode).attr('data-valid') == null ) || ( $('#payment-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('Numero invalide')}}, "
                    }
                    if ( $('#form-' + mode).find('.activity_service').length == 0 ) {
                        pass = false;
                        message += "{{__('Aucune ligne ajouté')}}, "
                    }
                    break;
                case "civile":
                    if ( ( $('#age-' + mode).attr('data-valid') == null ) || ( $('#age-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('age invalide')}}, "
                    }

                    if ( ( $('#chain-' + mode).attr('data-valid') == null ) || ( $('#chain-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('Reference invalide')}}, "
                    }
                    if ( ( $('#payment-' + mode).attr('data-valid') == null ) || ( $('#payment-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('Numero invalide')}}, "
                    }
                    if ( $('#form-' + mode).find('.activity_service').length == 0 ) {
                        pass = false;
                        message += "{{__('Aucune ligne ajouté')}}, "
                    }
                    break;
                case "sociale":
                    if ( ( $('#chain-' + mode).attr('data-valid') == null ) || ( $('#chain-' + mode).attr('data-valid') === 'false') ) {
                        pass = false;
                        message += "{{__('Reference invalide')}}, "
                    }
                    if ( $('#form-' + mode).find('.activity_service').length == 0 ) {
                        pass = false;
                        message += "{{__('Aucune ligne ajouté')}}, "
                    }
                    break;
            }
            if (pass) {
                $('#form-' + mode).find(':submit').attr("disabled", false);
                $('#form-' + mode).find(':submit').text("confirmer");
            } else {
                $('#form-' + mode).find(':submit').attr("disabled", true);
                $('#form-' + mode).find(':submit').text(message);
            }

        }


        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        let yyyy = today.getFullYear();

        today =  dd+ '/' + mm + '/' + yyyy;
        $("#submit-scolaire").on('click', function (e) {
            let depart_lignes = [];
            let arrive_lignes = [];
            let i;
            let valide = $('#date-phase-scolaire').text().split("=>");
            e.preventDefault();
            $('#form-scolaire').find('[name$="[depart]"]').each(function () {
                depart_lignes.push($(this).val());
            });
            $('#form-scolaire').find('[name$="[arrive]"]').each(function () {
                arrive_lignes.push($(this).val());
            });
            let lignes="" ;
            for (i=0;i<depart_lignes.length;i++) {

                lignes +='<tr style="margin: 0;padding: 0;">'+
                    '<td style=" text-align: center;">'+
                    '<div>'+arrive_lignes[i]+'</div>'+
                    '</td>'+

                    '<td style="text-align: center;padding-left: 100px;margin-top: 0">'+
                    '<div>'+depart_lignes[i]+'</div>'+
                    '</td>'+
                    '</tr>';
            }
            console.log(lignes);
            Swal.fire({
                title: '<i>{{__('Confirmation')}}</i> ',
                type: 'info',
                html:
                    '<div class="row m-0">'+
                    '    <div class="col-lg-4 ">'+
                    '        <div class="card-box ribbon-box border" style="width: 400px!important;height: 256px!important;border-radius: 11px;background-image:url({{asset('assets/images/backgroundScolaire.png')}});background-size: cover;">'+
                    '            <div class="ribbon-two ribbon-two-primary"><span>{{__('Scolaire')}}</span></div>'+
                    '            <div class="row" style="font-family: initial;color: black;">'+
                    '                <div class="col-4 float-left">'+
                    '                    <div class="row text-center  pull-left" style="margin-left: -33px;">'+
                    '                        <div class="col-12" style="margin-top: 40px; margin-left: -11px;">'+
                    '                            <p class="mb-0"><b>رقم البطاقة<br>'+$('#chain-scolaire').val()+'</b></p>'+
                    '                        </div>'+
                    '                        <div class="col-12 mb-1" style="margin-top: 4.5px">'+
                    '                            <img style="width: 95px;height: 99px;border-radius: 32px;" src="'+$('#picture-scolaire').attr('src')+'">'+
                    '                        </div>'+
                    '                        <div class="col-12 ">'+
                    '                            <p class="mb-0"><b>الثمن '+$('#price-scolaire').val()+'</b></p>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '                <div class="col-8 float-right">'+
                    '                    <div class="row text-right" style="font-size: 15px; padding-right: 0px; margin-top: 85px;">'+
                    '                        <div class="col-12">'+
                    '                            <p style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>الاسم واللقب :</b>'+
                    '                                <b>'+$('#name-scolaire').val()+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>تاریخ الولادة :</b>'+
                    '                                <b>'+$('#birth-scolaire').val()+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p  style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>سلمت في :</b>'+
                    '                                <b>'+today+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p style="margin-left: -11px;margin-bottom: 0!important;">'+
                    '                                <b>:صالحة من </b>'+
                    '                                <b>'+valide[0]+'</b>'+
                    '                                <b>:إلى </b>'+
                    '                                <b>'+valide[1]+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <div style="margin-bottom: 0!important;">'+
                    '                                <table style="float: right;font-weight: bold;border: none;border-collapse: collapse;margin: 0;padding: 0;border-spacing: 0; ">'+
                    '                                    <thead>'+lignes+
                    '                                    </thead>'+
                    '                                </table>'+
                    '                            </div>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+
                    '</div>'
                ,
                showCloseButton: true,
                showCancelButton: true,
                onAfterClose: () => window.scrollTo(0,0),
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: '<i class="mdi mdi-thumb-up-outline"></i> {{__('Confirmer')}}',
                cancelButtonText: '<i class="mdi mdi-thumb-down-outline">{{__('Annuler')}}</i>'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (!result.dismiss) {
                    $("#form-scolaire").submit();
                }
            });
        });
        $("#submit-civile").on('click', function (e) {

            let depart_lignes = [];
            let arrive_lignes = [];
            let i;
            let valide = $('#date-phase-civile').text().split("=>");
            e.preventDefault();
            $('#form-civile').find('[name$="[depart]"]').each(function () {
                depart_lignes.push($(this).val());
            });
            $('#form-civile').find('[name$="[arrive]"]').each(function () {
                arrive_lignes.push($(this).val());
            });
            var lignes="";
            for (i=0;i<depart_lignes.length;i++) {

                lignes+=  '<tr style="margin: 0;padding: 0;">'+
                    '<td style=" text-align: center;">'+
                    '<div>'+arrive_lignes[i]+'</div>'+
                    '</td>'+

                    '<td style="text-align: center;padding-left: 100px;margin-top: 0">'+
                    '<div>'+depart_lignes[i]+'</div>'+
                    '</td>'+
                    '</tr>';
            }
            Swal.fire({
                title: '<i>{{__('Confirmation')}}</i> ',
                type: 'info',
                html:
                    '<div class="row m-0">'+
                    '    <div class="col-lg-4 ">'+
                    '        <div class="card-box ribbon-box border" style="width: 400px!important;height: 256px!important;border-radius: 11px;background-image:url({{asset("assets/images/backgroundCivile.png")}});background-size: cover;">'+
                    '            <div class="ribbon-two ribbon-two-primary"><span>{{__('Civile')}}</span></div>'+
                    '            <div class="row" style="font-family: initial;color: black;">'+
                    '                <div class="col-4 float-left">'+
                    '                    <div class="row text-center  pull-left" style="margin-left: -33px;">'+
                    '                        <div class="col-12" style="margin-top: 40px; margin-left: -11px;">'+
                    '                            <p class="mb-0"><b>رقم البطاقة<br>'+$('#chain-civile').val()+'</b></p>'+
                    '                        </div>'+
                    '                        <div class="col-12 mb-1" style="margin-top: 4.5px">'+
                    '                            <img style="width: 95px;height: 99px;border-radius: 32px;" src="'+$('#picture-civile').attr('src')+'">'+
                    '                        </div>'+
                    '                        <div class="col-12 ">'+
                    '                            <p class="mb-0"><b>الثمن '+$('#price-civile').val()+'</b></p>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '                <div class="col-8 float-right">'+
                    '                    <div class="row text-right" style="font-size: 15px; padding-right: 0px; margin-top: 85px;">'+
                    '                        <div class="col-12">'+
                    '                            <p style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>الاسم واللقب :</b>'+
                    '                                <b>'+$('#name-civile').val()+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>تاریخ الولادة :</b>'+
                    '                                <b>'+$('#birth-civile').val()+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p  style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>سلمت في :</b>'+
                    '                                <b>'+today+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p style="margin-left: -2px;margin-bottom: 0!important;">'+
                    '                                <b>:صالحة من </b>'+
                    '                                <b>'+valide[0]+'</b>'+
                    '                                <b>:إلى </b>'+
                    '                                <b>'+valide[1]+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <div style="margin-bottom: 0!important;">'+
                    '                                <table style="float: right;font-weight: bold;border: none;border-collapse: collapse;margin: 0;padding: 0;border-spacing: 0; ">'+
                    '                                    <thead>'+lignes+
                    '                                    </thead>'+
                    '                                </table>'+
                    '                            </div>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+
                    '</div>'
                {{--      '<div class="card-box ribbon-box" style="background:white;width: 400px;height:250px;border: 1px solid #0a1520;border-radius: 1%;">'+--}}
                {{--      '<div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> {{__('civile')}}</div>'+--}}
                {{--      '<div class="ribbon-content">'+--}}
                {{--      '<div class="row ">'+--}}
                {{--     ' <div class="col-md-2">'+--}}
                {{--     ' <img style="width: 120%;" src="'+$('#picture-scolaire').attr('src')+'">'+--}}
                {{--      '</div>'+--}}
                {{--      '<div class="col-md-8 text-center">'+--}}
                {{--      '<p style="margin-bottom: 0!important;"><b>رقم البطاقة </b></p>'+--}}
                {{--  '<p><b>'+$('#chain-civile').val()+'</b></p>'+--}}
                {{--  '</div>'+--}}
                {{--  '</div>'+--}}
                {{--  '<div class="d-flex flex-row-reverse ">'+--}}
                {{--      '<p style="margin-bottom: 0!important;">'+--}}
                {{--      '<b>الاسم واللقب :</b>'+--}}
                {{--  '<b>'+$('#name-civile').val()+'</b>'+--}}
                {{--  '</p>'+--}}
                {{--  '</div>'+--}}
                {{--  '<div class="d-flex flex-row-reverse ">'+--}}
                {{--      '<p style="margin-bottom: 0!important;">'+--}}
                {{--      '<b>تاریخ الولادة :</b>'+--}}
                {{--  '<b>'+$('#birth-civile').val()+'</b>'+--}}
                {{--  '</p>'+--}}
                {{--  '<p class="pr-2" style="margin-bottom: 0!important;">'+--}}
                {{--      '<b>الصنف :</b>'+--}}
                {{-- '<b>مدني</b>'+--}}
                {{--  '</p>'+--}}
                {{--' </div>'+--}}
                {{-- ' <div class="d-flex flex-row-reverse ">'+--}}
                {{--      '<p style="margin-bottom: 0!important;">'+--}}
                {{--      '<b>الثمن :</b>'+--}}
                {{--  '<b>'+$('#price-civile').val()+'</b>'+--}}
                {{--  '</p>'+--}}
                {{--  '</div>'+--}}
                {{--  '<div class="d-flex flex-row-reverse ">'+--}}
                {{--     ' <p style="margin-bottom: 0!important;">'+--}}
                {{--      '<b>:صالحة من </b>'+--}}
                {{--      '<p><b>'+valide[0]+'</b></p>'+--}}
                {{--      '</p>'+--}}
                {{--  '<p class="pr-2" style="margin-bottom: 0!important;">'+--}}
                {{--      '<b>:إلى </b>'+--}}
                {{--  '<p><b>'+valide[1]+'</b></p>'+--}}
                {{--  '</p>'+--}}
                {{--  '</div>'+--}}
                {{--  '<div class="d-flex flex-row-reverse ">'+--}}
                {{--      '<div style="margin-bottom: 0!important;">'+--}}
                {{--      '<table style="float: right;font-weight: bold;border: 1px solid #000000;border-collapse: collapse;margin: 0;padding: 0;border-spacing: 0; ">'+--}}
                {{--  '<thead>'+--}}
                {{-- '<tr style="border: 1px solid #000000;">'+--}}
                {{--      '<td style=" text-align: center;">'+--}}
                {{--      '<div>وصولاً إلى&nbsp;</div>'+--}}
                {{--  '</td>'+--}}
                {{--  '<td style="text-align: center;padding-left: 100px;">'+--}}
                {{--      '<div>إنطلاقا من</div>'+--}}
                {{--  '</td>'+--}}
                {{-- ' </tr>'+--}}
                {{--          lignes+--}}
                {{--      '</thead>'+--}}
                {{--      '</table>'+--}}
                {{--     '</div>'+--}}
                {{--      '<p class="pr-2" style="margin-bottom: 0!important;">'+--}}
                {{--     '<b>سلمت في :</b>'+--}}
                {{-- ' <b>'+today+'</b>'+--}}
                {{--  '</p>'+--}}
                {{--  '</div>'+--}}
                {{--  '</div>'+--}}
                {{--  '</div>'--}}
                ,
                showCloseButton: true,
                showCancelButton: true,
                onAfterClose: () => window.scrollTo(0,0),
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: '<i class="mdi mdi-thumb-up-outline"></i> {{__('Confirmer')}}',
                cancelButtonText: '<i class="mdi mdi-thumb-down-outline">{{__('Annuler')}}</i>'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (!result.dismiss) {
                    $("#form-civile").submit();
                }
            });
        });
        $("#submit-sociale").on('click', function (e) {
            let depart_lignes = [];
            let arrive_lignes = [];
            let i;
            let valide = $('#date-phase-sociale').text().split("=>");
            e.preventDefault();
            $('#form-sociale').find('[name$="[depart]"]').each(function () {
                depart_lignes.push($(this).val());
            });
            $('#form-sociale').find('[name$="[arrive]"]').each(function () {
                arrive_lignes.push($(this).val());
            });
            var lignes="" ;
            for (i=0;i<depart_lignes.length;i++) {

                lignes+=  '<tr style="margin: 0;padding: 0;">'+
                    '<td style=" text-align: center;">'+
                    '<div >إلى '+arrive_lignes[i]+'</div>'+
                    '</td>'+
                    '<td style="text-align: center;padding-left: 100px;margin-top: 0">'+
                    '<div >من '+depart_lignes[i]+'</div>'+
                    '</td>'+
                    '</tr>';
            }

            Swal.fire({
                title: '<i>{{__('Confirmation')}}</i> ',
                type: 'info',
                html:
                    '<div class="row m-0">'+
                    '    <div class="col-lg-4 ">'+
                    '        <div class="card-box ribbon-box border" style="width: 400px!important;height: 256px!important;border-radius: 11px;background-image:url({{asset("assets/images/backgroundScolaire.png")}});background-size: cover;">'+
                    '            <div class="ribbon-two ribbon-two-primary"><span>{{__('Sociale')}}</span></div>'+
                    '            <div class="row" style="font-family: initial;color: black;">'+
                    '                <div class="col-4 float-left">'+
                    '                    <div class="row text-center  pull-left" style="margin-top: -33px">'+
                    '                        <div class="col-12" style="margin-top: 74px; margin-left: -11px;">'+
                    '                            <p class="mb-0"><b>رقم البطاقة<br>'+$('#chain-sociale').val()+'</b></p>'+
                    '                        </div>'+
                    '                        <div class="col-12 mb-1" style="margin-top: 4.5px; margin-left: -11px;"">'+
                    '                            <img style="width: 95px;height: 99px;border-radius: 32px;" src="'+$('#picture-sociale').attr('src')+'">'+
                    '                        </div>'+
                    '                        <div class="col-12 ">'+
                    '                            <p class="mb-0"><b>الثمن '+$('#price-sociale').val()+'</b></p>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '                <div class="col-8 float-right">'+
                    '                    <div class="row text-right" style="font-size: 15px; padding-right: 0px; margin-top: 85px;">'+
                    '                        <div class="col-12">'+
                    '                            <p style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>الاسم واللقب :</b>'+
                    '                                <b>'+$('#name-sociale').val()+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>تاریخ الولادة :</b>'+
                    '                                <b>'+$('#birth-sociale').val()+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p  style="float:right;margin-bottom: 0!important;">'+
                    '                                <b>سلمت في :</b>'+
                    '                                <b>'+today+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <p style="margin-left: -11px;margin-bottom: 0!important;">'+
                    '                                <b>:صالحة من </b>'+
                    '                                <b>'+valide[0]+'</b>'+
                    '                                <b>:إلى </b>'+
                    '                                <b>'+valide[1]+'</b>'+
                    '                            </p>'+
                    '                        </div>'+
                    '                        <div class="col-12">'+
                    '                            <div style="margin-bottom: 0!important;">'+
                    '                                <table style="float: right;font-weight: bold;border: none;border-collapse: collapse;margin: 0;padding: 0;border-spacing: 0; ">'+
                    '                                    <thead>'+lignes+
                    '                                    </thead>'+
                    '                                </table>'+
                    '                            </div>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '    </div>'+
                    '</div>'
                //       '<div class="container" style="background:white;width: 400px;height:250px;border: 1px solid #0a1520;border-radius: 1%;">'+
                //      '<div class="row ">'+
                //      ' <div class="col-md-2">'+
                //      ' <img style="width: 120%;" src="'+$('#picture').attr('src')+'">'+
                //       '</div>'+
                //       '<div class="col-md-8 text-center">'+
                //       '<p style="margin-bottom: 0!important;"><b>رقم البطاقة </b></p>'+
                //   '<p><b>'+$('#chain-sociale').val()+'</b></p>'+
                //   '</div>'+
                //   '</div>'+
                //   '<div class="d-flex flex-row-reverse ">'+
                //       '<p style="margin-bottom: 0!important;">'+
                //       '<b>الاسم واللقب :</b>'+
                //   '<b>'+$('#name-sociale').val()+'</b>'+
                //   '</p>'+
                //   '</div>'+
                //   '<div class="d-flex flex-row-reverse ">'+
                //       '<p style="margin-bottom: 0!important;">'+
                //       '<b>تاریخ الولادة :</b>'+
                //   '<b>'+$('#birth-sociale').val()+'</b>'+
                //   '</p>'+
                //   '<p  style="margin-bottom: 0!important;">'+
                //       '<b>الصنف :</b>'+
                //  '<b>إجتماعي</b>'+
                //   '</p>'+
                // ' </div>'+
                //  // ' <div class="d-flex flex-row-reverse ">'+
                //  //      '<p style="margin-bottom: 0!important;">'+
                //  //      '<b>الثمن :</b>'+
                //  //  '<b>'+$('#price-sociale').val()+'</b>'+
                //  //  '</p>'+
                //  //  '</div>'+
                //   '<div class="d-flex flex-row-reverse ">'+
                //      ' <p style="margin-bottom: 0!important;">'+
                //       '<b>:صالحة من </b>'+
                //       '<p><b>'+valide[0]+'</b></p>'+
                //       '</p>'+
                //   '<p  style="margin-bottom: 0!important;">'+
                //       '<b>:إلى </b>'+
                //   '<p><b>'+valide[1]+'</b></p>'+
                //   '</p>'+
                //   '</div>'+
                //   '<div class="d-flex flex-row-reverse ">'+
                //       '<div style="margin-bottom: 0!important;">'+
                //       '<table style="float: right;font-weight: bold;border: 1px solid #000000;border-collapse: collapse;margin: 0;padding: 0;border-spacing: 0; ">'+
                //   '<thead>'+
                //  '<tr style="border: 1px solid #000000;">'+
                //       '<td style=" text-align: center;">'+
                //       '<div>وصولاً إلى&nbsp;</div>'+
                //   '</td>'+
                //   '<td style="text-align: center;padding-left: 100px;">'+
                //       '<div>إنطلاقا من</div>'+
                //   '</td>'+
                //  ' </tr>'+
                //           lignes+
                //       '</thead>'+
                //       '</table>'+
                //      '</div>'+
                //       '<p  style="margin-bottom: 0!important;">'+
                //      '<b>سلمت في :</b>'+
                //  ' <b>'+today+'</b>'+
                //   '</p>'+
                //   '</div>'+
                //   '</div>'
                ,
                showCloseButton: true,
                showCancelButton: true,
                onAfterClose: () => window.scrollTo(0,0),
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: '<i class="mdi mdi-thumb-up-outline"></i> {{__('Confirmer')}}',
                cancelButtonText: '<i class="mdi mdi-thumb-down-outline">{{__('Annuler')}}</i>'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (!result.dismiss) {
                    $("#form-sociale").submit();
                }
            });
        });



        {{--$("[id^=submit-]").on('click', function (e) {--}}
        {{--    let depart_lignes = [];--}}
        {{--    let arrive_lignes = [];--}}
        {{--    e.preventDefault();--}}
        {{--    $('#form-' + mode).find('[name$="[depart]"]').each(function () {--}}
        {{--        depart_lignes.push($(this).val());--}}
        {{--    });--}}
        {{--    $('#form-' + mode).find('[name$="[arrive]"]').each(function () {--}}
        {{--        arrive_lignes.push($(this).val());--}}
        {{--    });--}}
        {{--    for (let i=0;i<depart_lignes.length;i++) {--}}
        {{--        console.log(depart_lignes[i] + ' => ' + arrive_lignes[i]);--}}
        {{--    }--}}
        {{--    Swal.fire({--}}
        {{--        title: '<i>HTML</i> <u>example</u>',--}}
        {{--        type: 'info',--}}
        {{--        html: 'You can use '+$('#age'+ mode).val()+'<b>bold text</b>, '+--}}
        {{--            '<a href="//coderthemes.com/">links</a> ' +--}}
        {{--            'and other HTML tags',--}}
        {{--        showCloseButton: true,--}}
        {{--        showCancelButton: true,--}}
        {{--        onAfterClose: () => window.scrollTo(0,0),--}}
        {{--        confirmButtonClass: 'btn btn-confirm mt-2',--}}
        {{--        cancelButtonClass: 'btn btn-cancel ml-2 mt-2',--}}
        {{--        confirmButtonText: '<i class="mdi mdi-thumb-up-outline"></i> {{__('Confirmer')}}',--}}
        {{--        cancelButtonText: '<i class="mdi mdi-thumb-down-outline"></i>'--}}
        {{--    }).then((result) => {--}}
        {{--        /* Read more about isConfirmed, isDenied below */--}}
        {{--        if (!result.dismiss) {--}}
        {{--            $("#form-"+mode).submit();--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        function loadFile(event, hmode) {
            let imgUpload = document.getElementById('upload-' + hmode);
            let totalFiles = imgUpload.files.length;
            let picturepreview = document.getElementById('picture-' +hmode);
            let pictureframe = document.getElementById('frame-' + hmode);
            if (!!totalFiles) {
                picturepreview.src = URL.createObjectURL(event.target.files[0]);
                picturepreview.classList.remove('d-none');
                pictureframe.classList.add('d-none');
                console.log('khdemt');
            } else {
                picturepreview.src = '{{asset('default.png')}}';
                picturepreview.classList.add('d-none');
                pictureframe.classList.remove('d-none');
                console.log('khdemt ama mafammech taswira ! ');
            }
        }

    </script>

@section('scroll')
@endsection


@endsection


