@extends('layouts.horizontal', ['title' => 'Customers'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Sociales')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Liste des Sociales')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Liste des Socials')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card border">
                    <div class="card-body">
                        @hasrole('admin')
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{route('socials.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i>{{__('Ajouter une Personne Sociale')}}</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
{{--                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-cog"></i></button>--}}
                                    <button type="button" class="btn btn-success mb-2 mr-1" data-toggle="modal" data-target="#info-alert-modal"><i class="mdi mdi-cog"></i> {{__('Import')}}</button>

                                </div>
                            </div><!-- end col-->
                            <!-- end col-->
                        </div>
                        @endhasrole
                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="customers-datatable">
                                <thead>
                                <tr>
                                    <th>{{__('Nom')}}</th>
                                    <th>{{__('Cin')}}</th>
                                    <th>{{__('Enfants')}}</th>
{{--                                    <th style="width: 75px;">{{__("Action")}}</th>--}}
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
        <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body ">
                        <div class="text-center">
                            <i class="dripicons-information h1 text-info"></i>
                            <h4 class="mt-2">Heads up!</h4>
                            <p class="mt-3"> </p>
                            <form action="{{route('socials.import')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label class="form-label" for="customFile">Importer un fichier excel</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div>
                                <button type="submit" class="btn btn-info my-2" >{{__('Importer')}}</button>
                                <button type="button" class="btn btn-danger my-2" data-dismiss="modal">{{__('Fermer')}}</button>

                            </form>

                            <!-- Preview -->


                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endsection

    @section('script')
        <!-- Plugins js-->
            <script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
            <!-- Page js-->
            <script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>

            <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
            <script src="{{asset('assets/libs/jquery-datatables-checkboxes/jquery-datatables-checkboxes.min.js')}}"></script>
            <script>
                $(function () {

                    var table = $('#customers-datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('socials.index') }}",
                        columns: [
                            {data: 'name', name: 'code'},
                            {data: 'cin', name: 'cin'},
                            {data: 'childrens', name: 'children'},

                            // {data: 'created_at', name: 'created_at'},
                            // {
                            //     data: 'action',
                            //     name: 'action',
                            //     orderable: true,
                            //     searchable: true
                            // },
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
                            setTimeout(function(){
                                $('#customers-datatable').DataTable().ajax.reload();
                            }, 1000);
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

