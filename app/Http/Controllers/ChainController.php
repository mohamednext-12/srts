<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Agency;
use App\Chain;
use App\Demand;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpseclib\Crypt\Random;
use PHPUnit\Framework\Constraint\Count;

class ChainController extends Controller
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
                $data = Chain::selectRaw('COUNT(id) as count,receipt,created_at')->whereNull('agency_id')->groupBy('receipt')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('envoyee', function($data){
                        return Chain::where('pack','!=',2)->where('receipt',$data->receipt)->count();
                    })
                    ->addColumn('reste', function($data){
                        return $data->count-$data->used;
                    })
                    ->addColumn('scolaire', function($data){
                        $scolaire=Chain::where('receipt',$data->receipt)->where('type','=','scolaire')->count();
                        return $scolaire;
                    })
                    ->addColumn('resteScolaire', function($data){
                        $scolaire=Chain::where('pack','=',2)->where('receipt',$data->receipt)->where('type','scolaire')->count();
                        return $scolaire;
                    })
                    ->addColumn('civile', function($data){
                        $civile=Chain::where('receipt',$data->receipt)->where('type','=','civile')->count();
                        return $civile;
                    })
                    ->addColumn('resteCivile', function($data){
                        $civile=Chain::where('pack','=',2)->where('receipt',$data->receipt)->where('type','civile')->count();
                        return $civile;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        elseif ($role=="supervisor"){
            $stock=Chain::where('used',0)
                ->where('confirmed',1)
                ->where('agency_id',$user->agency->id)
                ->whereNull('declaration_id')->count();
            $route=Chain::where('agency_id',$user->agency->id)
                   ->where('confirmed',0)->count();
            $return=Chain::where('agency_id',$user->agency->id)
                    ->whereNotNull('declaration_id')->count();
            $today=new \DateTime('today');
            $today=$today->format('Y-m-d');
            $retard=Chain::where('agency_id',$user->agency->id)
                ->where('date_arrive','<',$today)->where('confirmed','0')->count();
            $demand=Demand::where('agency_id',$user->agency->id)
            ->where('status',0)->count();

            if ($request->ajax()) {
                $data = Chain::selectRaw('COUNT(id) as count,used,type,pack,date_arrive')->where('agency_id',$user->agency->id)->groupBy('date_arrive')->get();

                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('reste', function($data){
                        return $data->count-$data->used;
                    })
                    ->addColumn('scolaire', function($data){

                        $scolaire=Chain::where('pack',$data->pack)->where('agency_id',auth()->user()->agency_id)
                            ->where('type','=','scolaire')->where('date_arrive','=',$data->date_arrive)->count();
                        return $scolaire;
                    })
                    ->addColumn('resteScolaire', function($data){
                        $scolaire=Chain::where('pack',$data->pack)->where('agency_id',auth()->user()->agency_id)
                            ->where('type','=','scolaire')->where('date_arrive','=',$data->date_arrive)
                            ->where('used',0)->count();
                        return $scolaire;
                    })
                    ->addColumn('civile', function($data){
                        $civile=Chain::where('receipt',$data->receipt)->where('agency_id',auth()->user()->agency_id)->where('type','=','civile')->count();
                        return $civile;
                    })
                    ->addColumn('resteCivile', function($data){
                        $civile=Chain::where('used','!=',2)->where('receipt',$data->receipt)->where('agency_id',auth()->user()->agency_id)->where('type','civile')->count();
                        return $civile;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }


        return view('chains.index',compact('stock','return','route','demand','retard'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agencies=Agency::all();

        return view('chains.create',compact('agencies'));
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
            foreach ($request->get('add') as $r)
            {
                    $chain = Chain::whereBetween('code',[$r['start'],$r['end']])->count();
//                    dd($chain);
                    if($chain != 0)
                    {
                        return redirect()->back()->with('error',__("le stock est existant"));
                    }
            }
            $data=[];
            foreach ($request->get('add') as $r)
            {
                for ($i=$r['start'];$i<=$r['end'];$i++)
                {
//                    $data += ['type' => $r['type'], 'code' => $i,'receipt'=>$request->receipt,'pack'=>2];
                    array_push($data,['type' => $r['type'], 'code' => $i,'receipt'=>$request->receipt,'pack'=>2]);
//                    $chain=new Chain;
//                    $chain->type=$r['type'];
//                    $chain->code=$i;
//                    $chain->receipt=$request->receipt;
//                    $chain->pack=2;
//                    $chain->save();
                }
            }
//            dd($data);
            DB::table('chains')->insert($data);

            return redirect(route('chains.index'));
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
//
//
//        $lots=DB::select('SELECT MIN(`code`) as min, MAX(`code`) as max,type
//            FROM
//            (SELECT @row_number:= CASE WHEN @id = type THEN @row_number ELSE @row_number + 1 END AS num,
//            @id:= pack as pack, receipt,type,`code`
//            FROM chains, (SELECT @row_number:= 0, @id:= 1) t ORDER BY `code`) t
//            WHERE t.pack = 2 and t.receipt = "14022021"
//            GROUP BY num,type');
//        dd($lots);

        return view('chains.send',compact('agencies','receipts'));
    }

    public function storeSend(Request $request)
    {

            $request->validate([
               'date'=>'required|date_format:Y-m-d|after:yesterday'
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
