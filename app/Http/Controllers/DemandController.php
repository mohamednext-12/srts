<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Chain;
use App\Demand;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $stock=Chain::where('used',0)
            ->where('confirmed',0)
            ->whereNull('declaration_id')
            ->whereNull('agency_id')
            ->whereNull('date_arrive')->count();
        $route=Chain::whereNotNull('agency_id')->count();
        $return=Chain::whereNotNull('declaration_id')->count();
        $today=new \DateTime('today');
        $today=$today->format('Y-m-d');
        $retard=Chain::where('date_arrive','<',$today)->where('confirmed','0')->count();
        $demand=Demand::where('status',0)->count();
        if ($request->ajax()) {
            $userRole=Auth::user()->getRoleNames()->first();
            if($userRole=="admin")
            $data = Demand::latest()->get();
            else
            $data = Demand::where('agency_id',Auth::user()->agency->id)->latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('agency', function($row){
                    $agency=Agency::where('id',$row->agency_id)->get()->pluck('name_french');
                    if(app()->getLocale()=='fr')
                    {
                        return $agency;
                    }
                    else{
                        return $agency->name_arab;
                    }

                })
                ->addColumn('status', function($row){
                    if($row->status==0)
                    $btn = '<a href="#" class="badge badge-soft-warning">'.__('En Attente').'</a>';
                    elseif($row->status==1)
                    $btn = '<a href="#" class="badge badge-soft-success">'.__('Acceptée').'</a>';
                    else
                    $btn = '<a href="#" class="badge badge-soft-danger">'.__('Refusée').'</a>';
                        return $btn;
                })
                ->addColumn('action', function($row){
                    $userRole=Auth::user()->getRoleNames()->first();
                    $accept=$userRole=="admin" ? '<button id="'.$row->id.'"  data-toggle="modal" data-target="#accept-alert-modal" class="accept btn btn-info btn-sm mr-1">'.__('Accepter').'</button>':'';
                    $refuse=$userRole=="admin" ? '<button id="'.$row->id.'"  data-toggle="modal" data-target="#refuse-alert-modal" class="refuse btn btn-danger btn-sm mr-1">'.__('Refuser').'</button>':'';

                    $btn = '<a href="'.route('demands.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    if($userRole=="admin")
                        return $accept.$refuse;
                    elseif($userRole!="admin" && $row->status==0)
                        return $btn;
                    else
                        return __('Modification impossible');

                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('demands.index',compact('stock','return','route','demand','retard'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('demands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'qty'=>'required',
            'date'=>'required'
        ]);
        $demand=new Demand;
        $demand->qty=$request->qty;
        $demand->date=$request->date;
        $demand->agency_id=Auth::user()->agency->id;
        $demand->save();
        return redirect(route('demands.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show(Demand $demand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit(Demand $demand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demand $demand)
    {
        request()->validate([
            'qty'=>'required',
            'date'=>'required'
        ]);
        $demand=new Demand;
        $demand->qty=$request->qty;
        $demand->date=$request->date;
        $demand->agency_id=Auth::user()->agency->id;
        $demand->update();
        return redirect(route('demands.index'));
    }
    public function accept(Demand $demand)
    {
        $demand->status=1;
        $demand->update();
        return response()->json([
            'agency_id' => $demand->agency_id,
            'date' => $demand->date,
            'qty' => $demand->qty,
        ]);
    }
    public function refuse(Demand $demand)
    {
        $demand->status=2;
        $demand->update();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        $demand->delete();
    }
}
