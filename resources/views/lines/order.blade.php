@extends('layouts.horizontal', ['title' => 'Drag and Drop | Dragula'])

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
                            <li class="breadcrumb-item active">{{__('Organisation des stations')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Organisation des stations')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="header-title text-center">{{__('Ligne')}} {{$line->num}}</h4>
                        <p class="text-muted font-14 mb-3 text-center">
                            <code> {{__("Déplacer des objets entre les conteneurs à l'aide de la poignée")}}</p></code>
                        </p>
                        <form action="{{route('line.order.save',$line->id)}}" method="post">
                            @csrf
                        <div class="row" data-plugin="dragula" data-containers='["handle-dragula-left"]' data-handleClass="dragula-handle">
                            <div class="col-md-12">
                                <div class="bg-light p-2 p-lg-4">
                                    <div id="handle-dragula-left" class="py-2">
                                        @foreach($stations as $station)
                                        <div class="card mb-0 mt-2">
                                            <div class="card-body">
                                                <div class="media">
                                                    <i class="fas fa-bus fa-3x mr-3 d-none d-sm-block avatar-sm rounded-circle"></i>
                                                    <div class="media-body" >
                                                        <input type="text" name="stations[]" hidden value="{{$station->id}}">
                                                        <h5 class="mb-1 mt-1">{{$station->name_french}}</h5>
                                                        <p class="mb-0"> {{$station->num}} </p>
                                                    </div> <!-- end media-body -->
                                                    <span class="dragula-handle"></span>
                                                </div> <!-- end media -->
                                            </div> <!-- end card-body -->
                                        </div> <!-- end col -->
                                        @endforeach
                                            <div class="text-center">
                                            <button type="submit" class="btn btn-primary mt-3 width-xl">{{__('confirmer')}}</button>
                                            </div>
                                    </div> <!-- end company-list-1-->
                                </div> <!-- end div.bg-light-->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->




    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/dragula/dragula.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/dragula.init.js')}}"></script>
@endsection
