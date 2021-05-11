<?php

namespace App\Http\Controllers;

use App\Line;
use App\LinePrice;
use App\LineStation;
use App\Station;
use App\SubscriptionCategory;
use App\SubscriptionPeriod;
use Illuminate\Http\Request;
use DataTables;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Line::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (Line $line) {
                    if(app()->getLocale()=='ar')
                    {
                        $first=$line->stations()->orderBy('order')->first()->name_arab;
                        $last=$line->stations()->orderBy('order','desc')->first()->name_arab;

                    }
                    else{
                        $first=$line->stations()->orderBy('order')->first()->name_french;
                        $last=$line->stations()->orderBy('order','desc')->first()->name_french;
                    }

                        return $first.'->'.$last;


                })
                ->addColumn('parcours', function (Line $line) {
                    $stations=$line->stations()->orderBy('order', 'asc')->get();
                    return $stations->map(function($station) {
                        return $station->num;
                    })->implode(',');
                })
                ->addColumn('action', function($row){
                    $line=$row->subscription()->count()>0;
                    if($line){
                        $btn = '<a href="'.route('lines.show',$row->id).'" class=" btn btn-info btn-sm mr-1">'.__('Afficher').'</a><div class="btn-group"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.__('Modifier').' <i class="mdi mdi-chevron-down"></i></button><div class="dropdown-menu"><a class="dropdown-item" href="'.route('lines.edit',$row->id).'">'.__('Ligne').'</a><a class="dropdown-item" href="'.route('line.order',$row->id).'">'.__('Stations').'</a></div></div> <button id="'.$row->id.'"  data-toggle="modal" data-target="#block-alert-modal" class="block btn btn-danger btn-sm">'.__('Bloquer').'</button>';
                    }
                    else{
                        $btn = '<a href="'.route('lines.show',$row->id).'" class=" btn btn-info btn-sm mr-1">'.__('Afficher').'</a><div class="btn-group"><button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.__('Modifier').' <i class="mdi mdi-chevron-down"></i></button><div class="dropdown-menu"><a class="dropdown-item" href="'.route('lines.edit',$row->id).'">'.__('Ligne').'</a><a class="dropdown-item" href="'.route('line.order',$row->id).'">'.__('Stations').'</a></div></div> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('lines.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stations=Station::all();
        $lines=Line::all();
        return view('lines.create',compact('stations','lines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $priceScolaire = number_format(floatval(str_replace(',','.',$request->get('price-scolaire'))), 3, '.', ' ');
        $priceCivile = number_format(floatval(str_replace(',','.',$request->get('price-civile'))), 3, '.', ' ');

        $request->validate([
           'num'=>'required|unique:lines,num',
           'price-scolaire'=>'required_without:price-civile|between:0,99.99',
           'price-civile'=>'required_without:price-scolaire|between:0,99.99'
        ]);

        $line=new Line();
        $line->num = $request->num;
        $line->distance=$request->distance;
        $line->save();

        if($request->get('scolaire'))
        {
            $line->categories()->attach($request->get('scolaire') , ['price' => $priceScolaire]);
        }

        if($request->get('civile'))
        {
            $line->categories()->attach($request->get('civile') , ['price' => $priceCivile]);
        }
        foreach ($request->stations as $key => $id) {
            $line->stations()->attach($id);
        }
        return redirect(route('line.order',$line->id));

    }
    public function order($id)
    {
        $line=Line::find($id);
        $stations=$line->stations()->orderBy('order', 'asc')->get();
        return view('lines.order',compact('stations','line'));
    }
    public function orderstore(Line $line,Request $request)
    {
        $stations=$request->stations;
        for($i=0;$i<=count($stations)-1;$i++)
        {
            $linestation=LineStation::where('line_id',$line->id)->where('station_id',$stations[$i])->first();
            $linestation->order=$i+1;
            $linestation->update();
        }
        return redirect(route('lines.index',$line->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function show(Line $line)
    {
        if(app()->getLocale()=='ar')
        {
            $first=$line->stations()->orderBy('order')->first()->name_arab;
            $last=$line->stations()->orderBy('order','desc')->first()->name_arab;

        }
        else{
            $first=$line->stations()->orderBy('order')->first()->name_french;
            $last=$line->stations()->orderBy('order','desc')->first()->name_french;
        }
        $name=$first.'->'.$last;

        return view('lines.show',compact('line','name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function edit(Line $line)
    {

        $line_scolaire=$line->categories()->where('subscription_category_id','1')->first();

        $line_civile=$line->categories()->where('subscription_category_id','2')->first();

        $stations=Station::all();

        return view('lines.edit',compact('line','stations','line_civile','line_scolaire'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Line $line)
    {
//        dd($request->get('price-scolaire'));
        $line->num = $request->num;
        $line->distance = $request->distance;

        $line->update();
        $line->categories()->sync([]);

        if($request->get('scolaire'))
        {
            $line->categories()->sync([$request->get('scolaire') => ['price' => $request->get('price-scolaire')]],false);
        }

        if($request->get('civile'))
        {
            $line->categories()->sync([$request->get('civile') => ['price' => $request->get('price-civile')]],false);
        }

        $line->stations()->sync($request->stations);
        return redirect(route('line.order',$line->id));
    }

    /**
     * SoftDelete a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function block(Line $line)
    {
        $line->delete();
    }

    /**
     * Display a listing of the SoftDeleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blocked(Request $request)
    {
        if ($request->ajax()) {
            $data = Line::latest()->onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (Line $line) {
                    if(app()->getLocale()=='ar')
                    {
                        $first=$line->stations()->orderBy('order')->first()->name_arab;
                        $last=$line->stations()->orderBy('order','desc')->first()->name_arab;

                    }
                    else{
                        $first=$line->stations()->orderBy('order')->first()->name_french;
                        $last=$line->stations()->orderBy('order','desc')->first()->name_french;
                    }
                    return $first.'->'.$last;
                })
                ->addColumn('parcours', function (Line $line) {
                    $stations=$line->stations()->orderBy('order', 'asc')->get();
                    return $stations->map(function($station) {
                        return $station->num;
                    })->implode(',');
                })
                ->addColumn('action', function($row){

                    $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#restore-alert-modal" class="restore btn btn-success btn-sm">'.__('Restaurer').'</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('lines.blocked');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        Line::withTrashed()->find($id)->restore();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function destroy(Line $line)
    {
        $line->forceDelete();
    }
}
