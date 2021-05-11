@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Pertes')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Déclarer Une Perte')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Déclarer Une Perte')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Création')}}</h4>
                        <ul class="nav nav-pills mt-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Avec Référence')}}</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Sans Référence')}}</a>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <p class="sub-header"><code>{{__('la référence des cartes serait attribué automatiquement lors du cloturation du stock')}}</code></p>
                                <form id="form" class="needs-validation"  method="POST" action="{{ route('declarations.store') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group mb-3 col-md-12">
                                            <p class="mb-1 font-weight-bold text-muted mt-3 mt-md-0">{{__('Reférence Stock')}}</p>

                                            <select name="declaration[]" class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                            @foreach($chains as $chain)
                                                <optgroup label="{{$chain->pack}}">
                                                    @foreach(\App\Chain::chainWithDate($chain->pack) as $chain)
                                                    <option value="{{$chain->id}}">{{$chain->code}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                                            <label for="reason">{{ __('Cause') }}</label>
                                            <select name="reason"  class="form-control" id="reason" @error('description') is-invalid @enderror placeholder="{{ __('description') }}" value="{{old('description')}}" required>
                                                @foreach($reasons as $reason)
                                                    <option value="{{$reason->id}}">{{$reason->name_french}}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('reason')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="description">{{ __('Description') }}</label>
                                            <input name="description" type="text" class="form-control" id="description" @error('description') is-invalid @enderror placeholder="{{ __('description') }}" value="{{old('description')}}" required>
                                            @error('description')
                                            <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-6 float-right">
                                            <a class="btn btn-success float-right mr-2" href="{{route('declarations.index')}}">{{ __('Retour') }}</a>
                                        </div>
                                        <div class="col-6 ">
                                            <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
{{--                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">--}}
{{--                                <p class="sub-header"><code>{{__('la référence des cartes serait attribué automatiquement lors du cloturation du stock')}}</code></p>--}}
{{--                                <form id="form" class="needs-validation"  method="POST" action="{{ route('declarations.store') }}">--}}
{{--                                    @csrf--}}
{{--                                    <div class="form-row">--}}
{{--                                        <div class="form-group mb-3 col-md-3">--}}
{{--                                            <label for="name_arab">{{ __('Quantité') }}</label>--}}
{{--                                            <input name="to_declare" type="text" class="form-control" id="to_declare" @error('to_declare') is-invalid @enderror placeholder="{{ __('Quantité') }}" value="{{old('to_declare')}}" required>--}}
{{--                                            @error('to_declare')--}}
{{--                                            <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group mb-3 col-md-9">--}}
{{--                                            <label for="chain">{{ __('Reférence Stock') }}</label>--}}
{{--                                            <select name="chain"  class="form-control" id="chain" @error('chain') is-invalid @enderror placeholder="{{ __('chain') }}" value="{{old('chain')}}" required>--}}
{{--                                                @foreach($chains as $chain)--}}
{{--                                                    <option value="{{$chain->pack}}">{{__("Date d'arrivé")}}:"{{$chain->pack}}" | {{__('Quantité')}}: "{{$chain->count}}"--}}
{{--                                                    </option>--}}

{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @foreach($chains as $chain)--}}
{{--                                                <input hidden name="qty{{$chain->pack}}" value="{{$chain->count}}">--}}
{{--                                                <input hidden name="used{{$chain->pack}}" value="{{$chain->used}}">--}}
{{--                                            @endforeach--}}

{{--                                        </div>--}}
{{--                                        <div class="form-group mb-3 col-md-6">--}}
{{--                                            <label for="reason">{{ __('Cause') }}</label>--}}
{{--                                            <select name="reason"  class="form-control" id="reason" @error('description') is-invalid @enderror placeholder="{{ __('description') }}" value="{{old('description')}}" required>--}}
{{--                                                @foreach($reasons as $reason)--}}
{{--                                                    <option value="{{$reason->id}}">{{$reason->name_french}}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}

{{--                                            @error('reason')--}}
{{--                                            <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group mb-3 col-md-6">--}}
{{--                                            <label for="description">{{ __('Description') }}</label>--}}
{{--                                            <input name="description" type="text" class="form-control" id="description" @error('description') is-invalid @enderror placeholder="{{ __('description') }}" value="{{old('description')}}" required>--}}
{{--                                            @error('description')--}}
{{--                                            <span class="invalid-feedback" style="display: block !important;" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row ">--}}
{{--                                        <div class="col-6 float-right">--}}
{{--                                            <a class="btn btn-success float-right mr-2" href="{{route('declarations.index')}}">{{ __('Retour') }}</a>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-6 ">--}}
{{--                                            <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}

                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection
@section('script')

    <!-- Plugins js-->

    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $('[data-toggle="select2"]').select2();
    </script>
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
        $('.date').datepicker({
            format: 'dd-mm-yy',
            autoclose: true,
            language: 'fr',
            startView: 1,
            maxViewMode: "months",
            orientation: "top left",
        })
    </script>
@endsection
