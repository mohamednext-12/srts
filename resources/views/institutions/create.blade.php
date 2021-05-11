@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Etablissement')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer Une Etablissement')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Etablissement')}}</h4>
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
                        <form class="needs-validation" novalidate method="POST" action="{{ route('institutions.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name_arab">{{ __("Nom d'etablissement en arabe") }}</label>
                                <input name="name_arab" type="text" class="form-control" id="name_arab" @error('name_arab') is-invalid @enderror placeholder="{{ __("Nom d'etablissement en arabe") }}" value="{{old('name_arab')}}" required>
                                @error('name')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name_arab">{{ __("Nom d'etablissement en francais") }}</label>
                                <input name="name_french" type="text" class="form-control " id="name_arab" @error('name_french') is-invalid @enderror placeholder="{{ __("Nom d'etablissement en francais") }}" value="{{old('name_french')}}" required>
                                @error('name')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <p class="mb-1 font-weight-bold ">{{ __('choisir la région') }}</p>
                                <select name="region" id="regions" class="form-control select2"  data-placeholder="{{ __('choisir la municipalité') }}">
                                    <option disabled selected></option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{$region->code}}|{{$region->name_arab}}|{{$region->name_french}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <p class="mb-1 font-weight-bold ">{{ __('choisir la municipalité') }}</p>
                                <select name="municipality" id="municipalities" class="form-control select2"  data-placeholder="{{ __('choisir la municipalité') }}">
{{--                                    @foreach($municipalities as $municipality)--}}
{{--                                        <option value="{{$municipality->id}}">{{$municipality->code}}|{{$municipality->name_arab}}|{{$municipality->name_french}}</option>--}}
{{--                                    @endforeach--}}
                                        <option disabled selected></option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                    <p class="mb-1 font-weight-bold text-muted">{{ __('choisir le niveau') }}</p>
                                <select name="level" class="form-control selectpicker show-tick"  data-style="btn-outline-primary" data-placeholder="{{ __('choisir le niveau') }}">
                                    @foreach($levels as $level)
                                        <option value="{{$level->id}}">{{$level->name_arab}}|{{$level->name_french}}</option>>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('institutions.index')}}">{{ __('Retour') }}</a>
                                </div>
                                <div class="col-6 ">
                                    <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $('.select2').select2();
    </script>
    <script>
        $(document).ready(function () {

            $('#regions').on('change', function () {

                $('#municipalities').html('');

                $.ajax({
                    url: "{{route('api.munbyreg')}}" + "/" + $('#regions').val(),
                    method: "get",
                    success: function (municipalities) {
                        console.log(municipalities);
                        httt = '<option disabled selected></option>';
                        $.each(municipalities, function (i) {

                            httt += '<option value="' + municipalities[i].id + '">' + municipalities[i].name_arab + '</option> ';
                        });
                        $('#municipalities').html(httt);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
