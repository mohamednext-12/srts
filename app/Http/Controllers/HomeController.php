<?php

namespace App\Http\Controllers;

use App\Client;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $abonnements=Subscription::count();
        $clients=Client::count();
        $money=Subscription::all()->sum('price');
        $currentDate = new \DateTime('-1 month');
        $endDate = new \DateTime('today');
//        $subs = Subscription::where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at->format('Y-m-d');
//            });
//
//        $subss = Subscription::where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at->format('Y-m-d');
//            });
//
//        while ($currentDate <= $endDate) {
//            $initsubscrips[$currentDate->format('Y-m-d')] = 0;
//            $initprixsubscrips[$currentDate->format('Y-m-d')] = 0;
//            $labels[] = $currentDate->format('d M Y');
//            $currentDate->modify('+1 day');
//        }
//
//
//        foreach ($subs as $key => $value) {
//            if (isset($initsubscrips[$key])) {
//                $initsubscrips[$key]=$value->count();
//            }
//        }
//        foreach ($subss as $key => $value) {
//            if (isset($initprixsubscrips[$key])) {
//                $initprixsubscrips[$key]=$value->sum('price');
//            }
//        }

        return view('dashboard',compact('abonnements','clients','money'));
    }
}
