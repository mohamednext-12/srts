@extends('layouts.horizontal', ['title' => 'Validation | Parsley'])
@section('css')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Stock')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Créer un Stocks')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Créer un Stocks')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Formulaire de Création')}}</h4>
                        <p class="sub-header"></p>
                        <form id="form" class="needs-validation"  method="POST" action="{{ route('chains.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group mb-3 col-md-3">
                                    <label for="start">{{ __('Debut Numéro Carte') }}</label>
                                    <input name="start" type="text" class="form-control " id="start" @error('start') is-invalid @enderror placeholder="{{ __('Debut Numéro Carte') }}" value="{{old('start')}}" >
                                    @error('start')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label for="end">{{ __('Fin Numéro Carte') }}</label>
                                    <input name="end" type="text" class="form-control " id="end" @error('end') is-invalid @enderror placeholder="{{ __('Fin Numéro Carte') }}" value="{{old('end')}}" >
                                    @error('end')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label for="name_arab">{{ __('Quantité') }}</label>
                                    <input name="qty" type="text" class="form-control" id="qty" @error('qty') is-invalid @enderror placeholder="{{ __('Quantité') }}" value="{{old('qty')}}" required>
                                    @error('qty')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label for="name_arab">{{ __('Bon de Commande') }}</label>
                                    <input name="pack" type="text" class="form-control" id="qty" @error('pack') is-invalid @enderror placeholder="{{ __('Numéro Bon de Commande') }}" value="{{old('pack')}}" required>
                                    @error('pack')
                                    <span class="invalid-feedback" style="display: block !important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--                            <div class="form-group mb-3 ">--}}
                            {{--                                <select id="agency" name="agency" class="form-control mt-2 "--}}
                            {{--                                        data-toggle="select2" data-placeholder="{{ __("choisir l'Agence") }}">--}}
                            {{--                                    @foreach($agencies as $agency)--}}
                            {{--                                        <option data-value="{{$agency->num}}"--}}
                            {{--                                                value="{{$agency->id}}">{{ __('Agence') }}--}}
                            {{--                                            : {{$agency->code}}|{{$agency->address}} </option>>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}

                            {{--                            </div>--}}
                            <button class="btn btn-primary" type="submit">{{ __('Confirmer') }}</button>
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
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
    <!-- Page js-->
    <script>
        $(document).ready(function () {
            $('#start').keyup(function () {
                let start = parseInt($(this).val());
                let end = parseInt($('#end').val());
                let test = testnum(start, end);
                if( test !== false ) {
                    $('#qty').val( test );
                } else {
                    console.log('erreur de nombre binomiale !!');
                }
            });
            $('#end').keyup(function () {
                let start = parseInt($("#start").val());
                let end = parseInt($(this).val());
                let test = testnum(start, end);
                if( test !== false ) {
                    $('#qty').val( test );
                } else {
                    console.log('erreur de nombre binomiale !!');
                }
            });
        });
        function testnum(debut,fin) {
            if (debut>fin) {
                return false;
            } else {
                return fin - debut +1 ;
            }
        }
    </script>


    <script>
        $('#agency').select2();
    </script>

@endsection
