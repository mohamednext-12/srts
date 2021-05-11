@extends('layouts.horizontal', ['title' => 'Customers'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Srts</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Etablissments')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Etablissments')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Liste des Etablissments')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card border">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{route('institutions.index')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>{{__('Liste des Etablissements')}}</a>
                            </div>
                            <!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="customers-datatable">
                                <thead>
                                <tr>
                                    {{--                                    <th>Code</th>--}}
                                    <th>Nom arabe</th>
                                    <th>Nom Francais</th>
                                    <th>municipalité</th>
                                    <th>niveau</th>
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
        <div id="restore-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-success">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-checkmark h1 text-white"></i>
                            <h4 class="mt-2 text-white">Restaurer !</h4>
                            <p class="mt-3 text-white">L'Institut va être Restaurer</p>
                            <button id="restore" type="button" class="btn btn-light my-2" data-dismiss="modal">Continue</button>
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
                        ajax: "{{ route('institutions.blocked') }}",
                        columns: [
                            // {data: 'code', name: 'code'},
                            {data: 'name_arab', name: 'name_arab'},
                            {data: 'name_french', name: 'name_french'},
                            {data: 'municipality', name: 'municipality'},
                            {data: 'level', name: 'niveau'},
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
                // Restore action
                $(document).on('click', '.restore', function(){
                    id = $(this).attr('id');
                    $('#'+id).parent().parent().css('border','2px solid green');
                });
                $('.modal').on('hidden.bs.modal',function () {
                    $('.restore').parent().parent().css('border','none');
                })
                $('#restore').click(function(){
                    $('#'+id).parent().parent().css('background-color','green');
                    $.ajaxSetup({
                        data: {  _token: '{{csrf_token()}}' },
                        type:'PATCH',
                        url:"/institutions/"+id+"/restore",
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

