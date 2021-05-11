<?php

namespace App\Http\Controllers;

use App\DemandHologram;
use App\Hologram;
use App\HologramCategories;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Agency;
use App\Chain;
use App\Demand;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpseclib\Crypt\Random;

class HologramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=Auth::user();
        $role=$user->getRoleNames()->first();
        if($role=="admin")
        {
            //cartes
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
            //hologrammes
            $stockHologram=Stock::where('qty','>','used')->get();
            $routeHologram=Hologram::where('confirmed',0)->get()->pluck('qty');
//            $returnHologram=Hologram::whereNotNull('declaration_id')->count();
            $today=new \DateTime('today');
            $today=$today->format('Y-m-d');
            $retardHologram=Hologram::where('date_arrive','<',$today)->where('confirmed','0')->count();
            $demandHologram=DemandHologram::where('status',0)->count();

            if ($request->ajax()) {
                $data = Stock::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                        $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        elseif ($role=="supervisor"){
//            $stock=Chain::where('used',0)
//                ->where('confirmed',1)
//                ->where('agency_id',$user->agency->id)
//                ->whereNull('declaration_id')->count();
//            $route=Chain::where('agency_id',$user->agency->id)
//                ->where('confirmed',0)->count();
//            $return=Chain::where('agency_id',$user->agency->id)
//                ->whereNotNull('declaration_id')->count();
//            $today=new \DateTime('today');
//            $today=$today->format('Y-m-d');
//            $retard=Chain::where('agency_id',$user->agency->id)
//                ->where('date_arrive','<',$today)->where('confirmed','0')->count();
//            $demand=Demand::where('agency_id',$user->agency->id)
//                ->where('status',0)->count();
//
//            if ($request->ajax()) {
//                $data = Chain::selectRaw('COUNT(id) as count,used,date_arrive')->where('agency_id',$user->agency->id)->groupBy('date_arrive')->get();
//
//                return Datatables::of($data)
//                    ->addIndexColumn()
//
//                    ->addColumn('reste', function($data){
//                        return $data->count-$data->used;
//                    })
//                    ->addColumn('action', function($row){
//                        $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
//                        return $btn;
//                    })
//                    ->rawColumns(['action'])
//                    ->make(true);
//            }
        }


        return view('holograms.index',compact('stock','return','route','demand','retard'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = HologramCategories::all();
        return view('holograms.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'receipt'=>'required',
        ]);
        foreach ($request->get('type') as $key=>$t)
        {
           $hologram = new Stock();
           $hologram->hologram_categories_id=$key;
           $hologram->receipt=$request->receipt;
           $hologram->qty=$t['qty'];
           $hologram->used=0;
           $hologram->save();
        }

        return redirect(route('holograms.index'));
    }
    public function send()
    {
        $agencies=Agency::all();
//        $receipt=Chain::where('pack',2)->orderBy('created_at')->distinct()->groupBy('receipt')->get();

        $receipts = DB::table('chains')
            ->select('receipt')
            ->groupBy('receipt')
            ->where('pack','=',2)
            ->distinct()->get();


//        $lots =
//            DB::select('SELECT MIN(`code`) as min, MAX(`code`) as max
//            FROM
//            (SELECT @row_number:= CASE WHEN @id = pack THEN @row_number ELSE @row_number + 1 END AS num,
//            @id:= pack as pack, receipt,
//            `code`
//            FROM chains, (SELECT @row_number:= 0, @id:= 1) t ORDER BY `code`) t
//            WHERE t.pack = 2 and t.receipt = "'.$receipt.'"
//            GROUP BY num');
//        dd($lots);
//        $chains=Chain::whereNull('agency_id')->where('used','0')->where('confirmed','0')->whereNull('declaration_id')->groupBy('pack')->get();
//        dd($chains);

        return view('chains.send',compact('agencies','receipts'));
    }

    public function storeSend(Request $request)
    {

        $request->validate([
            'date'=>'required|date_format:Y-m-d|after:hier'
        ]);

        $pack=Str::random(8);

        foreach ($request->get('send') as $s)
        {
            $chains=Chain::where('code','>=',$s['start'])
                ->Where('code','<=',$s['end'])->whereNull('agency_id')->get();

            foreach ($chains as $chain)
            {
                if($chain->agency_id==null){
                    $chain->agency_id=$request->agency;
                    $chain->date_arrive=$request->date;
                    $chain->pack=$pack;
                    $chain->update();
                }

            }
        }
        return redirect(route('shipment.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function edit(Chain $chain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chain $chain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chain  $chain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chain $chain)
    {
        //
    }

    public function LotByReceipt($receipt){
        $lots=   DB::select('SELECT MIN(`code`) as min, MAX(`code`) as max
            FROM
            (SELECT @row_number:= CASE WHEN @id = pack THEN @row_number ELSE @row_number + 1 END AS num,
            @id:= pack as pack, receipt,
            `code`
            FROM chains, (SELECT @row_number:= 0, @id:= 1) t ORDER BY `code`) t
            WHERE t.pack = 2 and t.receipt = "'.$receipt.'"
            GROUP BY num');

        return response()->json($lots);
    }
}
