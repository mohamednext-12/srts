@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/multiselect/multiselect.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
{{--    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}


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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Lignes')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer Une Ligne')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Ligne')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Création')}}</h4>
                        <p class="sub-header"></p>

                        <form method="post" class="needs-validation" action="{{route('lines.store')}}" novalidate>
                            @csrf
                            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">{{ __('Numéro') }}</label>
                                <input name="num" type="number" class="form-control"
                                       id="validationCustom01" @error('num') is-invalid
                                       @enderror placeholder="{{ __('numéro') }}"
                                       value="{{old('num')}}" required>
                                @error('num')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="stations">{{ __('Stations') }}</label>
{{--                                <div class="checkbox checkbox-primary mb-2">--}}
{{--                                    <input name="duplication" id="duplication" type="checkbox" >--}}
{{--                                    <label for="duplication">--}}
{{--                                        {{__('Dupliquer les stations d\'un autre ligne')}}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                            </div>
{{--                            <div class="form-group mb-3 d-none" id="line_div">--}}
{{--                                <select id="line" name="line" class="form-control select2-multiple mt-2"--}}
{{--                                        data-toggle="select2" data-placeholder="{{ __('choisir le ligne a dupliquer') }}">--}}
{{--                                    @foreach($lines as $line)--}}
{{--                                        <option data-value="{{$line->num}}"--}}
{{--                                                value="{{$line->id}}">{{ __('Station numéro') }}--}}
{{--                                            : {{$line->num}}</option>>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                                <div class="form-group mb-3">
                                <select id="stations" name="stations[]"
                                        class="form-control select2-multiple"
                                        data-toggle="select2" multiple="multiple"
                                        data-placeholder="{{ __('choisir les stations') }}">
                                    @foreach($stations as $station)
                                        <option data-value="{{$station->num}}"
                                                value="{{$station->id}}">{{ __('Station numéro') }}
                                            : {{$station->num}} @if(app()->getLocale()=='fr') {{$station->name_french}} @else {{$station->name_arab}} @endif</option>>
                                    @endforeach
                                </select>
                                </div>

                            <div class="row">
                                <div class="col-12 ">
                                    <div class="form-group mb-3">
                                        <label for="distance">{{__('Distance')}}</label>
                                        <input name="distance" class="form-control" type="text" placeholder="{{__('Distance')}} {{__('Km')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                    <div class="checkbox checkbox-primary mb-2">
                                    <input name="scolaire" id="scolaire" type="checkbox" value="1">
                                    <label for="scolaire">
                                        {{__('Scolaire')}}
                                    </label>
                            </div>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                     <div class="form-group mb-3">
{{--                                        <label for="stations">{{__('Prix')}}</label>--}}
                                        <input name="price-scolaire" class="form-control" type="text" placeholder="{{__('prix')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group mb-3">
                                    <div class="checkbox checkbox-primary mb-2">
                                    <input name="civile" id="civile" type="checkbox" value="2">
                                    <label for="civile">
                                        {{__('civile')}}
                                    </label>
                            </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                     <div class="form-group mb-3">
{{--                                        <label for="stations">{{__('Prix')}}</label>--}}
                                        <input name="price-civile" class="form-control" type="text" placeholder="{{__('prix')}}">
                                    </div>
                                </div>
                            </div>


                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('lines.index')}}">{{ __('Retour') }}</a>
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')

    <!-- Plugins js-->
    <script src="{{asset('assets/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-wizard.init.js')}}"></script>



    <script src="{{asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                if($(this).prop("checked") == true){
                    $('#line_div').removeClass('d-none');
                }
                else if($(this).prop("checked") == false){
                    $('#line_div').addClass('d-none');
                }
            });
        });

    </script>

    <script>
        $('#line').select2();
        $('#line').change(function () {
            $(this).find('option:selected').each(function () {
                console.log($(this).attr('data-value'));

            });
        });
        $('.select2-multiple').select2();
        $(".select2-multiple ").change(function () {
            $(this).find('option:selected').each(function () {
                console.log($(this).attr('data-value'));
                $(".sortable")
            });
        });
    </script>

@endsection
