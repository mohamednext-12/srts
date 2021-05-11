<?php

namespace App\Http\Controllers;

use App\r;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings=Setting::first();
        return view('settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function FileLogin(Request $request)
    {
        $file=$request->file('file') ;
        $imageName = "login.png";
        $file->storeAs('/',$imageName);
        $preview[] = asset('storage/login.png');
        return[ 'initialPreview' => $preview];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function FileTopbar(Request $request)
    {
        $file=$request->file('file') ;
        $imageName = "topbar.png";
        $file->storeAs('/',$imageName);
        $preview[] = asset('storage/topbar.png');
        return[ 'initialPreview' => $preview];
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function FileFavicon(Request $request)
    {
        $file=$request->file('file') ;
        $imageName = "favicon.png";
        $file->storeAs('/',$imageName);
        $preview[] = asset('storage/favicon.png');
        return[ 'initialPreview' => $preview];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(r $r)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings=Setting::first();
        $settings->age_scolaire=$request->age_scolaire;
        $settings->age_civile=$request->age_civile;
        $settings->save();

        return redirect(route('settings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy(r $r)
    {
        //
    }
}
