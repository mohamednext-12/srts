<?php

namespace App\Http\Controllers;

use App\SubscriptionCategory;
use App\SubscriptionPeriod;
use Illuminate\Http\Request;
use DataTables;

class SubscriptionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriptionCategory::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('periods', function (SubscriptionCategory $category) {
                    return $category->periods->map(function($period) {
                       if(app()->getLocale()=='fr')
                        return $period->name_french;
                        else
                        return $period->name_arab;

                    })->implode(',');
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('subscriptionCategories.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('subscriptionCategories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periods=SubscriptionPeriod::all();
        return view('subscriptionCategories.create',compact('periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=new SubscriptionCategory(request()->validate ([
            'name_french' => 'required|min:3|max:50',
            'name_arab' => 'required|min:3|max:50',
            'description' => 'required',
//            'type' => 'required',
        ]));
        $category->save();
        $periods=$request->period;
        foreach ($periods as $period)
        {
            $category->periods()->attach($period);
        }
        return redirect(route('subscriptionCategories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubscriptionCategory  $subscriptionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionCategory $subscriptionCategory)
    {
        return view('subscriptionCategories.show',compact('subscriptionCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubscriptionCategory  $subscriptionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionCategory $subscriptionCategory)
    {
        $periods=SubscriptionPeriod::all();
        return view('subscriptionCategories.edit',compact('subscriptionCategory','periods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubscriptionCategory  $subscriptionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionCategory $subscriptionCategory)
    {
        $subscriptionCategory->update(request()->validate ([
            'name_french' => 'required|min:3|max:50',
            'name_arab' => 'required|min:3|max:50',
            'description' => 'required',
//            'type' => 'required',
        ]));
        $periods=$request->period;
        $arr=[];
        foreach ($periods as $period)
        {
            array_push($arr,$period);
        }
        $subscriptionCategory->periods()->sync($arr);
        return redirect(route('subscriptionCategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubscriptionCategory  $subscriptionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionCategory $subscriptionCategory)
    {
        $subscriptionCategory->delete();
    }
}
