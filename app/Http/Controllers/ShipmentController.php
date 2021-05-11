<?php

namespace App\Http\Controllers;

use App\Chain;
use App\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function index() {

        $today = new \DateTime('today');

        $user = Auth::user();
        $role = $user->getRoleNames()->first();

        if($role == 'admin')
        {
            $events = Chain::whereNotNull('date_arrive')->groupBy('date_arrive')->get();
            $stock = Chain::where('used',0)
                ->where('confirmed',0)
                ->whereNull('declaration_id')
                ->whereNull('agency_id')
                ->whereNull('date_arrive')->count();
            $route = Chain::whereNotNull('agency_id')->count();
            $return = Chain::whereNotNull('declaration_id')->count();
            $thisday = new \DateTime('today');
            $thisday = $thisday->format('Y-m-d');
            $retard = Chain::where('date_arrive','<',$thisday)->where('confirmed','0')->count();
            $demand = Demand::where('status',0)->count();
        }

        else {
            $events = Chain::where('agency_id',$user->agency_id)->whereNotNull('date_arrive')->groupBy('date_arrive')->get();
            $stock = Chain::where('used',0)
                ->where('confirmed',1)
                ->where('agency_id',$user->agency->id)
                ->whereNull('declaration_id')->count();
            $route = Chain::where('agency_id',$user->agency_id)
                ->where('confirmed',0)->count();
            $return = Chain::where('agency_id',$user->agency_id)
                ->whereNotNull('declaration_id')->count();
            $thisday = new \DateTime('today');
            $thisday = $thisday->format('Y-m-d');
            $retard = Chain::where('agency_id',$user->agency_id)
                ->where('date_arrive','<',$thisday)->where('confirmed','0')->count();
            $demand = Demand::where('agency_id',$user->agency_id)
                ->where('status',0)->count();
        }

        return view('shipments.index',compact('events','today','stock','return','route','demand','retard'));
    }
}
