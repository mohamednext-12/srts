<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        $first=Subscription::orderBy('created_at')->pluck('created_at')->first();
        $last=new \DateTime('today');
        $scolaireDates = [];
        $civileDates = [];
        $socialeDates = [];
        while($first <= $last){
            $scolaireDates[$first->format('d M Y') .' GMT'] = Subscription::where('category_id','1')->whereDate('created_at',$first->format('Y-m-d'))->count();
            $civileDates[$first->format('d M Y') .' GMT'] = Subscription::where('category_id','2')->whereDate('created_at',$first->format('Y-m-d'))->count();
            $socialeDates[$first->format('d M Y') .' GMT'] = Subscription::where('category_id','3')->whereDate('created_at',$first->format('Y-m-d'))->count();
            $first = $first->modify('+1 day');

        }//a refaire

        return view('rapports.index',compact('scolaireDates','civileDates','socialeDates'));
    }
}
