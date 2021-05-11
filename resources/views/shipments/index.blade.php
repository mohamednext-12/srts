@extends('layouts.horizontal', ['title' => 'Calendar'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/fullcalendar-v3/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .text-b td{
            color: black !important;
        }
    </style>
@endsection

@section('content')

    <!-- Start Content-->
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
                <a href="{{route('shipment.index')}}">
                    <div class="widget-rounded-circle card-box" style="border: #0a62de 2px solid;cursor: pointer">
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
                    <div class="widget-rounded-circle card-box" style="cursor: pointer">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Stock')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Stock en Route')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('Stock en Route')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                @hasrole('admin')
                                <a href="{{route('chains.send')}}" class="btn btn-lg font-16 btn-primary btn-block" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i>
                                    {{'Envoyer un Stock'}}</a>
                                @endhasrole
                                <div id="external-events" class="m-t-20">
                                    <br>
{{--                                    <p class="text-muted">Drag and drop your event or click in the calendar</p>--}}
                                    <div class="external-event bg-success" data-class="bg-success">
                                        <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i> {{__('Stock Envoyée')}}
                                    </div>
{{--                                    <div class="external-event bg-info" data-class="bg-info">--}}
{{--                                        <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>My Event--}}
{{--                                    </div>--}}
                                    <div class="external-event bg-warning" data-class="bg-warning">
                                        <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>{{__('Stock en Route')}}
                                    </div>
{{--                                    <div class="external-event bg-danger" data-class="bg-danger">--}}
{{--                                        <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Create New theme--}}
{{--                                    </div>--}}
                                </div>



                            </div> <!-- end col-->

                            <div class="col-lg-9">
                                <div id="calendar"></div>
                            </div> <!-- end col -->

                        </div>  <!-- end row -->
                    </div> <!-- end card body-->
                </div> <!-- end card -->

                <!-- Add New Event MODAL -->
                <div class="modal fade" id="event-modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h5 class="modal-title" id="modal-title">Event</h5>
                            </div>
                            <div class="modal-body p-4">
                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Event Name</label>
                                                <input class="form-control" placeholder="Insert Event Name"
                                                       type="text" name="title" id="event-title" required />
                                                    <div class="invalid-feedback" style="display: block !important;">Please provide a valid event name</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">Category</label>
                                                <select class="form-control custom-select" name="category"
                                                        id="event-category" required>
                                                    <option value="bg-danger" selected>Danger</option>
                                                    <option value="bg-success">Success</option>
                                                    <option value="bg-primary">Primary</option>
                                                    <option value="bg-info">Info</option>
                                                    <option value="bg-dark">Dark</option>
                                                    <option value="bg-warning">Warning</option>
                                                </select>
                                                <div class="invalid-feedback" style="display: block !important;">Please select a valid event category</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-light mr-1" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end modal-content-->
                    </div> <!-- end modal dialog-->
                </div>
                <!-- end modal-->
            </div>
            <!-- end col-12 -->
        </div> <!-- end row -->

    </div> <!-- container -->

@endsection

@section('script')
    <!-- Plugins js-->

    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/libs/fullcalendar-v3/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/libs/fullcalendar-v3/fullcalendar.all.js')}}"></script>

    <script>
        // sample calendar events data
        var curYear = moment().format('YYYY');
        var curMonth = moment().format('MM');
        var today = moment().day();
        var deliveredReports = {
            id: 1,
            textColor: 'black',
            events: [
                @foreach($events as $ev)
                {
                    id: '{{$ev->id}}',
                    start: moment('{{$ev->date_arrive}}'),
                    end: moment('{{$ev->date_arrive}}'),
                    title: 'Le Pack :' + '{{$ev->pack}}',
                    @if($today->diff(new DateTime($ev->date_arrive))->format('%a') <= 0)
                    status:'pending',
                    className: 'bg-warning text-b '
                    @else
                    status:'done',
                    className: 'bg-success text-b '
                    @endif
                },
                @endforeach
            ]
        };


        // initialize the calendar
        $('#calendar').fullCalendar({
            locale: '{{app()->getLocale()}}',
            header: {
                left: 'prev,today,next',
                center: 'title',
                right: 'month,listMonth'
            },
            firstDay: today,
            selectConstraint: {
                start: today
            },
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar
            dragRevertDuration: 0,
            defaultView: 'month',
            eventLimit: true, // allow "more" link when too many events
            eventSources: [deliveredReports],
            eventClick: function(info) {  $('#calendar').onEventClick(info); },
            dayClick: function(date, jsEvent, view) {
                console.log('day clicked');
                // if (date.diff(moment()) > 0) {
                //     $('#deadline').val(date.format());
                //     $("#createReportModal").modal("show");
                // }
            },
        });
        var isEventOverDiv = function(x, y) {
            var external_events = $( '#external-events' );
            var offset = external_events.offset();
            offset.right = external_events.width() + offset.left;
            offset.bottom = external_events.height() + offset.top;

            // Compare
            if (x >= offset.left
                && y >= offset.top
                && x <= offset.right
                && y <= offset .bottom) { return true; }
            return false;
        }
    </script>
@endsection
