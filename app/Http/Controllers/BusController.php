<?php

namespace App\Http\Controllers;

use App\Bus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bus::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('buses.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'" data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('bus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bus $bus)
    {

        $validation=request()->validate ([
            'brand' => 'required|min:1|max:20',
            'number_place' => 'required|min:1|max:100',
            'date_circulation' => 'required',
            'condition' => 'required',
            'comment'=>'required'
        ]);

        Bus::create($validation);

        return view('bus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        return view('bus.edit',compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update( Bus $bus)
    {
        $validation=request()->validate ([
            'brand' => 'required|min:1|max:20',
            'number_place' => 'required|min:1|max:100',
            'date_circulation' => 'required',
            'condition' => 'required',
            'comment'=>'required'
        ]);

        $bus->update($validation);
//        $validation=request()->validate ([
//            'brand' => 'required|min:1|max:20',
//            'number_place' => 'required|min:1|max:100',
//            'date_circulation' => 'required',
//            'condition' => 'required',
//            'comment'=>'required'
//        ]);
//        $bus->brand=$request->brand;
//        $bus->number_place=$request->number_place;
//        $bus->date_circulation=$request->date_circulation;
//        $bus->condition=$request->condition;
//        $bus->comment=$request->comment;
//        $bus->update();
        return view('bus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
    }
}
