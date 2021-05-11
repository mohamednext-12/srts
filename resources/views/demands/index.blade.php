@extends('layouts.horizontal', ['title' => 'Customers'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-3 ">
                <a href="{{route('chains.index')}}">
                    <div class="widget-rounded-circle card-box" style="cursor: pointer">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="fe-shopping-bag font-22 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup">{{$stock}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('Stock Disponible')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->

            <div class="col-md-3 ">
                <a href="{{route('chains.index')}}">
                    <div class="widget-rounded-circle card-box" style="cursor: pointer">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                    <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup">{{$route}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('Stock En Route')}} </p>
                                    <p class="text-muted mb-1 text-truncate">{{__('Stock En Retard')}}: {{$retard}} </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->

            <div class="col-md-3 ">
                <a href="{{route('declarations.index')}}">
                    <div class="widget-rounded-circle card-box" style="cursor: pointer">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup">{{$return}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('Liste des Retours')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->

            <div class="col-md-3 ">
                <a href="{{route('demands.index')}}">
                    <div class="widget-rounded-circle card-box" style="border: #0a62de 2px solid;cursor: pointer">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                    <i class="fe-eye font-22 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup">{{$demand}}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">{{__('Liste des Demandes')}}</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a>
            </div> <!-- end col-->
        </div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Demandes')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Demandes')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Liste des Demandes')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card border">
                    <div class="card-body">
                        <div class="row mb-2">
                            @unlessrole('admin')
                            <div class="col-sm-4">
                                <a href="{{route('demands.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>{{__('Ajouter une demande')}}</a>
                            </div>
                            <!-- end col-->
                            @endunlessrole
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="customers-datatable">
                                <thead>
                                <tr>
                                    <th>{{__('Agence')}}</th>
                                    <th>{{__('Quantité')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Statut')}}</th>
                                    <th style="width: 75px;">{{__("Action")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        <!-- Danger Alert Modal -->
        <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-wrong h1 text-white"></i>
                            <h4 class="mt-2 text-white">Suppression !</h4>
                            <p class="mt-3 text-white">Cette Action est irreversible</p>
                            <button id="delete" type="button" class="btn btn-light my-2" data-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Refuse Alert Modal -->
        <div id="refuse-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-wrong h1 text-white"></i>
                            <h4 class="mt-2 text-white">Suppression !</h4>
                            <p class="mt-3 text-white">Cette Action est irreversible</p>
                            <button id="refuse" type="button" class="btn btn-light my-2" data-dismiss="modal">{{__('Refuser')}}</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Success Alert Modal -->
        <div id="accept-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-success">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-checkmark h1 text-white"></i>
                            <h4 class="mt-2 text-white">Well Done!</h4>
                            <p class="mt-3 text-white"></p>
                            <button id="accept" type="button" class="btn btn-light my-2" data-dismiss="modal">{{__('Accepter')}}</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-datatables-checkboxes/jquery-datatables-checkboxes.min.js')}}"></script>
    <script>
        $(function () {

            var table = $('#customers-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('demands.index') }}",
                columns: [
                    // {data: 'code', name: 'code'},
                    {data: 'agency', name: 'agency'},
                    {data: 'qty', name: 'qty'},
                    {data: 'date', name: 'date'},
                    {
                        data: 'status',
                        name: 'status',
                    },
                    // {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
    <script>
        // Delete action
        $(document).on('click', '.delete', function(){
            id = $(this).attr('id');
            $('#'+id).parent().parent().css('border','2px solid #ff6666');
        });
       $('.modal').on('hidden.bs.modal',function () {
           $('.delete').parent().parent().css('border','none');
       })
        $('#delete').click(function(){
            $('#'+id).parent().parent().css('background-color','#ff6666');
            $.ajaxSetup({
                data: {  _token: '{{csrf_token()}}' },
                type:'DELETE',
                url:"/demands/"+id,
            });
            $.ajax({
                success:function(data)
                {
                    setTimeout(function(){
                        $('#customers-datatable').DataTable().ajax.reload();
                    }, 1000);
                }
            });
        });

       // Accept action
        $(document).on('click', '.accept', function(){
            id = $(this).attr('id');
            $('#'+id).parent().parent().css('border','2px solid #1cbb00');
        });
       $('.modal').on('hidden.bs.modal',function () {
           $('.accept').parent().parent().css('border','none');
       })
        $('#accept').click(function(){
            // $('#'+id).parent().parent().css('background-color','#1cbb00');
            $.ajaxSetup({
                data: {  _token: '{{csrf_token()}}' },
                type:'PUT',
                url:"/demands/accept/"+id,
            });
            $.ajax({
                success:function(data)
                {
                    var url = "{{route('chains.send')}}?agency_id=" + encodeURIComponent(data.agency_id) + "&date=" + encodeURIComponent(data.date)
                        + "&qty=" + encodeURIComponent(data.qty);
                    window.location.href = url;
                }
            });
        });
 // Refuse action
        $(document).on('click', '.refuse', function(){
            id = $(this).attr('id');
            $('#'+id).parent().parent().css('border','2px solid #ff6666');
        });
       $('.modal').on('hidden.bs.modal',function () {
           $('.refuse').parent().parent().css('border','none');
       })
        $('#refuse').click(function(){
            $('#'+id).parent().parent().css('background-color','#ff6666');
            $.ajaxSetup({
                data: {  _token: '{{csrf_token()}}' },
                type:'PUT',
                url:"/demands/refuse/"+id,
            });
            $.ajax({
                success:function(data)
                {
                    setTimeout(function(){
                        $('#customers-datatable').DataTable().ajax.reload();
                    }, 1000);
                }
            });
        });



    </script>
    <!-- Page js-->
@endsection

