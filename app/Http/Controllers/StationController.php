<?php

namespace App\Http\Controllers;

use App\Line;
use App\Station;
use Illuminate\Http\Request;
use PHPUnit\Util\Type;
use Yajra\DataTables\Facades\DataTables;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Station::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('lines', function (Station $station) {
                    return $station->lines->map(function($line) {
                        return $line->num;
                    })->implode(',');
                })
                ->addColumn('action', function($row){
                    $station=$row->lines()->count()>0;
                        if($station){
                            $btn = '<a href="'.route('stations.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a>';
                        }
                        else{
                            $btn = '<a href="'.route('stations.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
//        <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#danger-alert-modal">Danger Alert</button>
        return view('stations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $line=Line::all()->sortBy('num');
        return view('stations.create',compact('line'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $station=Station::create(request()->validate ([
            'name_arab' => 'required|min:3|max:50',
            'name_french' => 'required|min:3|max:50',
            'num' => 'required|min:1|max:5',
            'lat' => 'required',
            'long' => 'required',
        ]));
        $station->lines()->attach($request->lines);
        return redirect(route('stations.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        $lines=Line::all();
        return view('stations.edit',compact('station','lines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Station $station)
    {
        $station->update(request()->validate ([
            'name_arab' => 'required|min:3|max:50',
            'name_french' => 'required|min:3|max:50',
            'num' => 'required|min:1|max:5',
            'lat' => 'required',
            'long' => 'required',
        ]));
        $station->lines()->sync($request->lines);

        return redirect(route('stations.index'));
    }

    /**
     * SoftDelete a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function block(Station $station)
    {
        $station->delete();
    }

    /**
     * Display a listing of the SoftDeleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blocked(Request $request)
    {
        if ($request->ajax()) {
            $data = Station::latest()->onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('lines', function (Station $station) {
                    return $station->lines->map(function($line) {
                        return $line->num;
                    })->implode(',');
                })
                ->addColumn('action', function($row){
                    $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#restore-alert-modal" class="restore btn btn-success btn-sm">'.__('Restaurer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stations.blocked');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        Station::withTrashed()->find($id)->restore();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        $station->forceDelete();
    }
}
