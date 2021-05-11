<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Municipality;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agency::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('municipality', function (Agency $agency) {
                     $municipality=$agency->municipality()->first();
                     return $municipality->name_french;
                })
                ->addColumn('users', function (Agency $agency) {
                    $count=$agency->users()->count();
                    $userpic="";
                    $users=$agency->users ;
                    foreach ($users as $user){
                        $picture=$user->picture ? url('../storage/app/users/'.$user->picture) : asset('assets/images/user.png');
                        $userpic.='<a href="'.route('users.show',$user->id).'" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="'.$user->name.'" data-original-title="'.$user->name.'"><img style="width: 30px; height: 30px; border: 1px solid #6658dd57;" src="'.$picture.'" class="rounded-circle avatar-xs" alt="friend"></a>';
                    }
                    $btn= '<div class="avatar-group"><span class="badge badge-soft-success mr-2">'.$count.'</span>'.$userpic.'</div>';
//                    return '<span class="badge badge-success mr-2">'.$users.'</span>';
                    return $btn;
                })
                ->addColumn('action', function($row){
                    $users=$row->users()->count()>0;
                    if (  $users ) {
                        $btn = '<a href="' . route('agencies.show', $row->id) . '" class=" btn btn-info btn-sm mr-1">' . __('Afficher') . '</a><a href="' . route('agencies.edit', $row->id) . '" class="edit btn btn-success btn-sm mr-1">' . __('Modifier') . '</a><button id="'.$row->id.'" href="' . route('agencies.block', $row->id) . '" data-toggle="modal" data-target="#block-alert-modal" class="block btn btn-danger btn-sm">' . __('Bloquer') . '</button> ';
                    }else{
                        $btn = '<a href="' . route('agencies.show', $row->id) . '" class=" btn btn-info btn-sm mr-1">' . __('Afficher') . '</a><a href="' . route('agencies.edit', $row->id) . '" class="edit btn btn-success btn-sm mr-1">' . __('Modifier') . '</a><button id="'.$row->id.'" href="' . route('agencies.destroy', $row->id) . '" data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">' . __('Supprimer') . '</button> ';
                    }
                        return $btn;
                })
                ->rawColumns(['action','users'])
                ->make(true);
        }
        return view('agencies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipalities=Municipality::all();
        return view('agencies.create',compact('municipalities'));
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
            'name_french'=>'required|min:4',
            'name_arab'=>'required|min:4',
            'code'=>'required|min:2',
            'address'=>'required|min:4',
        ]);
        $agency=new Agency;
        $agency->name_french=$request->name_french;
        $agency->name_arab=$request->name_arab;
        $agency->code=$request->code;
        $agency->address=$request->address;
        $agency->municipality_id=$request->municipality;
        $agency->save();

       return redirect (route('agencies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        $currentDate = new \DateTime('monday this week');
        $endDate = new \DateTime('sunday this week');

//        $sub_scolaire = Subscription::where('category_id',1)->where('agency_id',$agency->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at->format('Y-m-d');
//            });
//        $sub_civile = Subscription::where('category_id',2)->where('agency_id',$agency->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at->format('Y-m-d');
//            });
//        $sub_sociale = Subscription::where('category_id',3)->where('agency_id',$agency->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at->format('Y-m-d');
//            });
//
//        while ($currentDate <= $endDate) {
//            $initscolaire[$currentDate->format('Y-m-d')] = 0;
//            $initcivile[$currentDate->format('Y-m-d')] = 0;
//            $initsociale[$currentDate->format('Y-m-d')] = 0;
//            $currentDate->modify('+1 day');
//        }
//
//        foreach ($sub_scolaire as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//        }foreach ($sub_civile as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//        }foreach ($sub_sociale as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//        }

        $subscriptions=Subscription::where('agency_id',$agency->id)->count();

//        return view('agencies.show',compact('agency','subscriptions','initscolaire','initcivile','initsociale'));
        return view('agencies.show',compact('agency','subscriptions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        $municipalities=Municipality::all();
        return view('agencies.edit',compact('agency','municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {
        request()->validate([
            'name_french'=>'required|min:4',
            'name_arab'=>'required|min:4',
            'code'=>'required|min:2',
            'address'=>'required|min:4',
        ]);
        $agency->name_french=$request->name_french;
        $agency->name_arab=$request->name_arab;
        $agency->code=$request->code;
        $agency->address=$request->address;
        $agency->municipality_id=$request->municipality;
        $agency->update();

        return redirect (route('agencies.index'));
    }

    /**
     * SoftDelete a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function block(Agency $agency)
    {
        $agency->users()->delete();
        $agency->delete();
    }

    /**
     * Display a listing of the SoftDeleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blocked(Request $request)
    {
        if ($request->ajax()) {
            $data = Agency::latest()->onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('municipality', function (Agency $agency) {
                    $municipality=$agency->municipality()->first();
                    return $municipality->name_french;
                })
                ->addColumn('users', function (Agency $agency) {
                    $users=$agency->users()->withTrashed()->count();
                    return '<span class="badge badge-success mr-2">'.$users.'</span>';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route('agencies.restore', $row->id) . '" id="'.$row->id.'"  data-toggle="modal" data-target="#restore-alert-modal" class="restore btn btn-success btn-sm mr-1">' . __('Restaurer') . '</a>';
                    return $btn;
                })
                ->rawColumns(['action','users'])
                ->make(true);
        }
        return view('agencies.blocked');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $agency=Agency::withTrashed()->find($id);
        User::withTrashed()->where('deleted_at',$agency->deleted_at)->restore();
        $agency->restore();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        $agency->forceDelete();
    }
}
