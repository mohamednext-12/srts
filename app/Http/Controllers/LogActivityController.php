<?php

namespace App\Http\Controllers;

use App\SubscriptionCategory;
use App\SubscriptionPeriod;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;


class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Activity::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (Activity $activity) {
                    $user=User::find($activity->causer_id);
                    return $user->name;
                })

                ->addColumn('agency', function (Activity $activity) {
                    $user=User::find($activity->causer_id);
                    if($user->hasRole('admin')){
                        return 'admin';
                    }else{
                    $agency=$user->agency()->first();
                    return $agency->name_french;}
                })
                ->addColumn('role', function (Activity $activity) {
                    $user=User::find($activity->causer_id);
                    $role=$user->getRoleNames();
                    return $role;
                })
                ->addColumn('description', function (Activity $activity) {
                    if($activity->description=="created")
                    {
                        return '<h4><span class="badge badge-soft-success">'.__('Création').'</span></h4>';
                    }
                    else if($activity->description=="updated")
                    {
                        return '<h4><span class="badge badge-soft-warning">'.__('Modification').'</span></h4>';
                    }
                    else if($activity->description=="deleted"){
                        return '<h4><span class="badge badge-soft-danger">'.__('Suppression').'</span></h4>';
                    }
                })
                ->addColumn('subject_type', function (Activity $activity) {
                    switch ($activity->subject_type)
                    {
                       case 'App\User':
                           return '<p>'.__("Utilisateur").'</p>';
                       break;
                       case 'App\Subscription':
                           return '<p>'.__("Abonnement").'</p>';
                       break;
                       case 'App\Chain':
                           return '<p>'.__("Stock").'</p>';
                       break;
                       case 'App\Agency':
                           return '<p>'.__("Agence").'</p>';
                       break;
                       case 'App\Line':
                           return '<p>'.__("Ligne").'</p>';
                       break;
                       case 'App\Station':
                           return '<p>'.__("Stations").'</p>';
                       break;
                    }
//                    if($activity->subject_type=="App\User"){
//                        return '<p>'.__("Utilisateur").'</p>';
//                    }
//                    elseif ($activity->subject_type=="App\Chain"){
//                        return '<p>'.__("Stock").'</p>';
//                    }
//                    else
                })
                ->addColumn('date', function (Activity $activity) {
                    return Carbon::parse($activity->created_at)->format('d/m/Y h:i:s');
                })

                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.__('Modifier').' <i class="mdi mdi-chevron-down"></i></button><div class="dropdown-menu"><a class="dropdown-item" href="'.route('lines.edit',$row->id).'">'.__('Ligne').'</a><a class="dropdown-item" href="'.route('line.order',$row->id).'">'.__('Stations').'</a></div></div> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action','description','subject_type'])
                ->make(true);
        }
        return view('activities.index');
    }

}
