@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
{{--    {{dd($errors)}}--}}
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Agences')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer Une Agence')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer Une Agence')}}</h4>
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

                        <form id="form" class="needs-validation"  method="POST" action="{{ route('agencies.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name_french">{{ __('Nom Agence francais') }}</label>
                                    <input name="name_french" type="text" class="form-control " id="name_french" @error('name_french') is-invalid @enderror placeholder="{{ __('Nom Agence') }}" value="{{old('name_french')}}" required>
                                    @error('name_french')
                                    <span class="invalid-feedback" style="display: block !important;"  role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="name_arab">{{ __('Nom Agence arabe') }}</label>
                                    <input name="name_arab" type="text" class="form-control " id="name_arab" @error('name') is-invalid @enderror placeholder="{{ __('Nom Agence') }}" value="{{old('name_arab')}}" required>
                                    @error('name_arab')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               <div class="form-group mb-3 col-md-6">
                                    <label for="code">{{ __('Code Agence') }}</label>
                                    <input name="code" type="text" class="form-control " id="code" @error('code') is-invalid @enderror placeholder="{{ __('Code Agence') }}" value="{{old('code')}}" required>
                                    @error('code')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               <div class="form-group mb-3 col-md-6">
                                    <label for="address">{{ __('Adresse Agence') }}</label>
                                    <input name="address" type="text" class="form-control " id="address" @error('address') is-invalid @enderror placeholder="{{ __('Adresse Agence') }}" value="{{old('address')}}" required>
                                    @error('address')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group mb-3 ">
                                <label for="address">{{ __('Municipalité Agence') }}</label>
                                <select id="municipality" name="municipality" class="form-control mt-2 "
                                        data-toggle="select2" data-placeholder="{{ __("choisir l'Agence") }}">
                                    @foreach($municipalities as $municipality)
                                        <option data-value="{{$municipality->id}}"
                                                value="{{$municipality->id}}">
                                            {{$municipality->name_french}}|{{$municipality->code}} </option>>
                                    @endforeach
                                </select>

                            </div>
                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('agencies.index')}}">{{ __('Retour') }}</a>
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

    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
    <!-- Plugins js-->


    <script>
        $('#municipality').select2();
    </script>

@endsection
