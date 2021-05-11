<?php

namespace App\Http\Controllers;

use App\Education;
use App\Institution;
use App\Level;
use App\Municipality;
use App\Region;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rules\In;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Institution::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('municipality', function (Institution $institution) {
                    $municipality= Municipality::where('id',$institution->municipality_id)->first();
                    return isset($municipality) ? $municipality->name_french : null;
                })
                ->addColumn('level', function (Institution $institution) {
                    $level= Level::where('id',$institution->level_id)->first();
                    return $level->name_french;
                })
                ->addColumn('action', function($row){
                    $education=Education::where('institution_id',$row->id)->count();
                    $count=$education>0;
                    if ( $count )
                    {
                        $btn = '<a href="'.route('institutions.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#block-alert-modal" class="block btn btn-danger btn-sm">'.__('Bloquer').'</button>';
                    }
                    else{
                        $btn = '<a href="'.route('institutions.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('institutions.index');
    }
    public function create()
    {
        $regions=Region::all();
        $municipalities=Municipality::orderBy('code')->get();
        $levels=Level::all();
        return view('institutions.create',compact('municipalities','levels','regions'));
    }
    public function store(Request $request)
    {
//        dd($request->all());
        request()->validate ([
//            'code' => 'required|min:1|max:50',
            'name_arab' => 'required|min:4|max:50',
            'name_french' => 'required|min:4|max:50',
        ]);
        $institution=new Institution();
//        $institution->code=request()->code;
        $institution->name_arab=request()->name_arab;
        $institution->name_french=request()->name_french;
        $institution->municipality_id=request()->municipality;
        $institution->level_id=request()->level;
        $institution->save();

        return redirect(route('institutions.index'));
    }
    public function edit(Institution $institution)
    {
        $regions=Region::all();
        $municipalities=Municipality::orderBy('code')->get();
        $levels=Level::all();
        return view('institutions.edit',compact('institution','municipalities','levels','regions'));
    }
    public function update(Institution $institution)
    {
        $institution->update(request()->validate ([
//            'code' => 'required|min:1|max:50',
            'name_arab' => 'required|min:4|max:50',
            'name_french' => 'required|min:4|max:50',
//            'level' => 'required|min:4|max:50',
//            'municipality' => 'required|min:4|max:50',
        ]));
        return redirect(route('institutions.index'));
    }

    /**
     * SoftDelete a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function block(Institution $institution)
    {
        $institution->delete();
    }

    /**
     * Display a listing of the SoftDeleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blocked(Request $request)
    {
        if ($request->ajax()) {
            $data = Institution::latest()->onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('municipality', function (Institution $institution) {
                    $municipality= Municipality::where('id',$institution->municipality_id)->first();
                    return $municipality->name_french;
                })
                ->addColumn('level', function (Institution $institution) {
                    $level= Level::where('id',$institution->level_id)->first();
                    return $level->name_french;
                })
                ->addColumn('action', function($row){
                    $btn = ' <button id="'.$row->id.'"  data-toggle="modal" data-target="#restore-alert-modal" class="restore btn btn-danger btn-sm">'.__('Restaurer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('institutions.blocked');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        Institution::withTrashed()->find($id)->restore();
    }



    public function destroy(Institution $institution)
    {
        $institution->delete();
    }
    public function MunByReg($region)
    {
        $municipalities =Municipality::where('region_id',$region)->get();
        return response()->json($municipalities);
    }
}
