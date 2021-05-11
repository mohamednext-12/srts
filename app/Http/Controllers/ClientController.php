<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use App\Subscription;
use App\SubscriptionCategory;
use Carbon\Carbon;
use Dotenv\Repository\AdapterRepository;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Client::all();
//            $data=$data->except('id',Auth::id());
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('name', function (Client $client) {
                    if ($client->picture)
                    {
                        $userPicture=url('../storage/app/clients/'.$client->picture);
                    }
                    else{
                        $userPicture=asset('default.png');
                    }

                    $picture='<td class="table-user"> <img style="width: 30px; height: 30px; border: 1px solid #6658dd57;" src="'.$userPicture.'" alt="table-user" class="mr-2 rounded-circle"> <a href="javascript:void(0);" class="text-body font-weight-semibold">'.$client->name.'</a> </td>';
                    return $picture;
                })
//                ->addColumn('subscriptions', function (Client $client) {
//                    $subscription = $client->subscriptions()->get();
//                        return $subscription;
//                })
                ->addColumn('birth', function (Client $client) {
                    if (app()->getLocale()=='fr'){

                        $birth=Carbon::parse($client->birth)->format('d/m/Y');
                    }
                    else{
                        $birth=Carbon::parse($client->birth)->format('Y/m/d');
                    }

                    return $birth;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('clients.show',$row->id).'" class="edit btn btn-info btn-sm">'.__('Afficher').'</a> ';
                    return $btn;
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }

        return view('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $address=Address::where('client_id',$client->id);
        $address=$address->get()->last();
        $scolaire=Subscription::where('client_id',$client->id)->where('category_id',1)->count();
        $civile=Subscription::where('client_id',$client->id)->where('category_id',2)->count();
        $sociale=Subscription::where('client_id',$client->id)->where('category_id',3)->count();
        $date=Subscription::first();
        $date=$date->created_at;
        $currentDate = $date;
        $endDate = new \DateTime('this year');


//        $test=Subscription::select(DB::raw('count(id) as `data`,category_id'), DB::raw("DATE_FORMAT(created_at, '%Y') new_date"),  DB::raw('YEAR(created_at) years'))
//        ->groupby('years','category_id')
//        ->get();
//
//        $sub_scolaire = Subscription::where('category_id',1)->where('client_id',$client->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at;
//            });
//
//        $sub_civile = Subscription::where('category_id',2)->where('client_id',$client->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at;
//            });
//            $sub_sociale = Subscription::where('category_id',3)->where('client_id',$client->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at;
//            });
//        while ($currentDate <= $endDate) {
//            $initscolaire[$currentDate->format('Y')] = 0;
//            $initcivile[$currentDate->format('Y')] = 0;
//            $initsociale[$currentDate->format('Y')] = 0;
//            $currentDate->modify('+1 year');
//        }
//
//        foreach ($sub_scolaire as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//        }
//        foreach ($sub_civile as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//        }
//        foreach ($sub_sociale as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//    }
        return view('clients.show',compact('client','address','scolaire','civile','sociale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
