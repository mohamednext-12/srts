
@switch($type)
    @case('scolaire')
    @if($subs->count())
        @foreach($subs as $sub)
            <div class="card border border-success">
                <div class="card-body">
                    <span class="badge badge-soft-success float-right">{{$sub->category->name_french}}</span>
                    <h5 class="mt-0"><a href="javascript: void(0);" class="text-success">{{$sub->client->name}}</a></h5>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col">
                            <a href="javascript: void(0);" class="text-reset">
                                <img src="{{$sub->client->picture ? asset('storage/clients/'.$sub->client->picture) :asset('assets/images/default_scolaire.png')}}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"
                                     style="height: 4.25rem;width: 4.25rem;">
                                <span class="d-none d-md-inline-block ml-1 font-weight-semibold">{{__('Age')}} {{$sub->client->age}}
{{--                                    {{$sub->client->birth ? ($sub->client->birth):''}}--}}
                                </span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="text-right text-muted">
                                <p class="font-13 mt-2 mb-0"><i class="mdi mdi-calendar"></i> {{$sub->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 " style="justify-content: center;">
                        <button onclick="fill('{{json_encode($sub)}}')" class="btn btn-success btn-trigger-verif">{{__('utiliser les données')}}</button>
                    </div>
                </div> <!-- end card-body-->
            </div>
        @endforeach
    @endif
    <div class="border border-success card mt-2">
        <div class="card-body">
            <div class="row" style="justify-content: center;">
                <button onclick="useCin('{{$cin}}')" data-dismiss="modal" class="btn btn-success btn-trigger-verif">{{__('Creer un utilisateur')}}</button>
            </div>
        </div>
    </div>
    @break
    @case('civile')
    @if($subs->count())
        @foreach($subs as $sub)
            <div class="card border border-success">
                <div class="card-body">
                    <span class="badge badge-soft-success float-right">{{$sub->category->name_french}}</span>
                    <h5 class="mt-0"><a href="javascript: void(0);" class="text-success">{{$sub->client->name}}</a></h5>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col">
                            <a href="javascript: void(0);" class="text-reset">
                                <img src="{{$sub->client->picture ? asset('storage/clients/'.$sub->client->picture) :asset('assets/images/default_civile.jpg')}}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle">
                                <span class="d-none d-md-inline-block ml-1 font-weight-semibold">{{__('Age')}} {{$sub->client->age}}
{{--                                    {{$sub->client->birth ? ($sub->client->birth):''}}--}}
                                </span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="text-right text-muted">
                                <p class="font-13 mt-2 mb-0"><i class="mdi mdi-calendar"></i> {{$sub->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <button onclick="fill('{{json_encode($sub)}}')" class="btn btn-success btn-trigger-verif">{{__('utiliser les données')}}</button>
                    </div>
                </div> <!-- end card-body-->
            </div>
        @endforeach
    @else
        <div class="card border border-success">
            <div class="card-body">
                <div class="row" style="justify-content: center;">
                    <button onclick="useCin('{{$cin}}')" class="btn btn-success btn-trigger-verif">{{__('Creer un utilisateur')}}</button>
                </div>
            </div>
        </div>
    @endif
    @break
    @case('sociale')
{{--    <div class="alert alert-warning">--}}
{{--        {{__('il reste :s abonnement(s)',['s' => $remaining])}}--}}
{{--    </div>--}}
    @if($subs->count())
        @foreach($subs as $sub)
            <div class="card border border-success">
                <div class="card-body">
                    <span class="badge badge-soft-success float-right">{{__('Sociale')}}</span>
                    <h5 class="mt-0"><a href="javascript: void(0);" class="text-success">{{$sub->name}}</a></h5>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col">
                            <a href="javascript: void(0);" class="text-reset">
                                <img src="{{$sub->picture ? asset('storage/clients/'.$sub->picture) :asset('assets/images/default_scolaire.png')}}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle">
                                <span class="d-none d-md-inline-block ml-1 font-weight-semibold">{{__('Age')}} {{$sub->age}}
{{--                                    {{$sub->birth ? ($sub->birth):''}}--}}
                                </span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <div class="text-right text-muted">
                                <p class="font-13 mt-2 mb-0"><i class="mdi mdi-calendar"></i> {{$sub->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <button onclick="fill('{{json_encode($sub)}}')" class="btn btn-success btn-trigger-verif" >{{__('utiliser les données')}}</button>
                    </div>
                </div> <!-- end card-body-->
            </div>
        @endforeach
    @endif
    @if($remaining > 0)
        <div class="card">
            <div class="card-body">
                <div class="row" style="justify-content: center;">
                    <button onclick="useCin('{{$cin}}')" class="btn btn-success btn-trigger-verif">{{__('Creer un utilisateur')}}</button>
                </div>
            </div>
        </div>
    @endif
    @break
@endswitch

