<?php

namespace App\Http\Controllers;

use App\Client;
use App\Imports\SocialImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Social;
use Illuminate\Http\Request;
use DataTables;
class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Social::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $client=Client::where('parent_cin',$row->cin)->first();
                    return $client->parent_name;
                })
                ->addColumn('childrens', function($row){
                    $client=Client::where('parent_cin',$row->cin)->count();
                    return $client;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('socials.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socials.create');
    }

    public function import(Request $request)
    {

        Excel::import(new SocialImport(), $request->file('file'));

        return redirect(route('socials.index'))->with('success', 'All good!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $social=new Social(request()->validate ([
            'cin' => 'required|min:8|max:8|unique:socials,cin',
            'children' => 'required|min:1|max:2',
        ]));
        $social->save();
        return redirect(route('socials.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        //
    }
}
