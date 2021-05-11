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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Sociales')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Ajouter une Personne Sociale')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Ajouter une Personne Sociale')}}</h4>
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

                        <form id="form" class="needs-validation" novalidate method="POST" action="{{ route('socials.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="cin">{{ __('Cin') }}</label>
                                    <input name="cin" type="number" minlength="8" maxlength="8" class="form-control" id="cin" @error('cin') is-invalid @enderror placeholder="{{ __('Cin') }}" value="{{old('cin')}}" required>
                                @error('cin')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="children">{{ __('Nombre Enfants') }}</label>
                                <input name="children"  type="text" class="form-control" id="children" @error('children') is-invalid @enderror placeholder="{{ __('Nombre Enfants') }}" value="{{old('children')}}" required>
                                @error('children')
                                <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row ">
                                <div class="col-6 float-right">
                                    <a class="btn btn-success float-right mr-2" href="{{route('socials.index')}}">{{ __('Retour') }}</a>
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
    <!-- Plugins js-->



    <!-- Page js-->
    {{--    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>--}}
@endsection
