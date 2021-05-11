<?php

namespace App\Http\Controllers;

use App\Phase;
use App\SubscriptionPeriod;
use Illuminate\Http\Request;
use DataTables;

class SubscriptionPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriptionPeriod::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('phases', function (SubscriptionPeriod $period) {
                    $phase=Phase::where('period_id',$period->id)->get();
                    return $phase->map(function($phase) {
                        return $phase->name_french;
                    })->implode(',');
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('subscriptionPeriods.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('subscriptionPeriods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscriptionPeriods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $period=SubscriptionPeriod::create(request()->validate ([
            'name_arab' => 'required|min:3|max:50',
            'name_french' => 'required|min:3|max:50',
        ]));
        if($request->index>=1)
        {
            $index=intval($request->index);
            for($i=1;$i<=$index;$i++)
            {
                  $phase=new Phase;
                  $phase->code=$i;
                  $phase->period_id=$period->id;
                  $phase->name_arab=$request->phase_arab[$i];
                  $phase->name_french=$request->phase_french[$i];
                  $phase->start=$request->date_deb[$i];
                  $phase->end=$request->date_fin[$i];
                  $phase->save();
            }
        }
        return redirect(route('subscriptionPeriods.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubscriptionPeriod  $subscriptionPeriod
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPeriod $subscriptionPeriod)
    {
        return view('subscriptionPeriods.show',compact('subscriptionPeriod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubscriptionPeriod  $subscriptionPeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPeriod $subscriptionPeriod)
    {
        return view('subscriptionPeriods.edit',compact('subscriptionPeriod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubscriptionPeriod  $subscriptionPeriod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionPeriod $subscriptionPeriod)
    {
        $subscriptionPeriod->update(request()->validate ([
            'name' => 'required|min:3|max:50',
            'description' => 'required',
        ]));
        return redirect(route('subscriptionPeriods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubscriptionPeriod  $subscriptionPeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionPeriod $subscriptionPeriod)
    {
        $subscriptionPeriod->delete();
    }
}
