<?php

namespace App\Http\Controllers;

use App\Chain;
use App\Declaration;
use App\Demand;
use App\Reason;
use App\Stock;
use DemeterChain\C;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeclarationController extends Controller
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
            $data = Declaration::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('qtys', function (Declaration $declaration) {
                    return $declaration->chain->count();
                })
                ->addColumn('reason', function (Declaration $declaration) {
                    $reason=$declaration->reason;
                        return $reason->name_french;
                })
                ->addColumn('agency', function (Declaration $declaration) {
                    $user=$declaration->user;
                        return $user->name;
                })
                ->addColumn('user', function (Declaration $declaration) {
                    $user=$declaration->user;
                        return $user->name;
                })
//                ->addColumn('chain', function (Declaration $declaration) {
//                    $chain=$declaration->chain;
//                        return $chain->qty-($chain->used+$chain->returned);
//                })
                ->addColumn('action', function($row){
                    $btn = ' <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('declarations.index',compact('stock','return','route','demand','retard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=Auth::user();
        $reasons=Reason::all();
        $chains=Chain::select('pack', DB::raw('count(id) as chains'))
                    ->where('used', '=',0)
                    ->whereNull('declaration_id')
                    ->where('pack','!=',2)
                    ->groupBy('pack')
                    ->get();
//        dd($chains);
        return view('declarations.create',compact('reasons','chains'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $declaration=new Declaration;
        $declaration->description=$request->description;
        $declaration->reason_id=$request->reason;
        $declaration->user_id=$user->id;
        $declaration->save();

        if($request->declaration){
            $declarations = $request->get('declaration');

            $chains=Chain::whereIn('id',$declarations)->get();
            foreach ($chains as $chain)
            {
                $chain->declaration_id=$declaration->id;
                $chain->save();
            }

        }else{
            $qty=$request->get('qty'.$request->chain);
            if (($request->to_declare)>$qty)
            {
                return redirect()->back()->with('error','la quantité dépasse le stock disponible');
            }
            elseif (($request->to_declare)==$qty)
                {
                $chains=Chain::where('agency_id',$user->agency->id)
                              ->where('date_arrive',$request->chain)
                              ->where('used',0)
                              ->whereNull('declaration_id')
                              ->get();
                    foreach ($chains as $chain)
                    {
                        $chain->declaration_id=$declaration->id;
                        $chain->save();
                    }
            }

         $stock=new Stock;
         $stock->agency_id=$user->agency_id;
         $stock->declaration_id=$declaration->id;
         $stock->date_arrive=$request->chain;
         $stock->to_declare=$request->to_declare;
         $stock->qty=$qty;
         $stock->used=$request->used;
         $stock->save();

        }

        return redirect(route('declarations.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function show(Declaration $declaration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function edit(Declaration $declaration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Declaration $declaration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Declaration  $declaration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Declaration $declaration)
    {
        $chain=Chain::find($declaration->chain->id);
        $chain->returned-=$declaration->qty;
        $chain->save();
        $declaration->delete();
    }
}
