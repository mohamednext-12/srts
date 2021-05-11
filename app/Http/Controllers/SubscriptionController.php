<?php

namespace App\Http\Controllers;

use App\Address;
use App\Center;
use App\Chain;
use App\Classroom;
use App\Client;
use App\Company;
use App\Education;
use App\Institution;
use App\Level;
use App\Line;
use App\LinePrice;
use App\Mandat;
use App\Method;
use App\Municipality;
use App\Payment;
use App\Phase;
use App\Region;
use App\Setting;
use App\Social;
use App\Subscription;
use App\SubscriptionCategory;
use App\SubscriptionPeriod;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use mysql_xdevapi\TableUpdate;
use phpseclib\Crypt\Random;
use PDF;
use function foo\func;
use function GuzzleHttp\Promise\all;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscription::latest()->take(1000);
            return Datatables::of($data)
                ->addIndexColumn()
//                ->addColumn('created_at', function (Subscription $subscription) {
//                    $date=Carbon::parse($subscription->created_at)->diffForHumans();
//                    return $date;
//                })
                ->addColumn('client', function (Subscription $subscription) {
                    $client= $subscription->client()->first();
                    return $client->name;
                })

                ->addColumn('line', function (Subscription $subscription) {
                    $line=$subscription->line()->first();

                        if (app()->getLocale()=='ar')
                        {
                        return $line->stations()->orderBy('order')->first()->name_arab."->".$line->stations()->orderBy('order','desc')->first()->name_arab;
                        }
                        else{
                            return  $line->stations()->orderBy('order')->first()->name_french."->".$line->stations()->orderBy('order','desc')->first()->name_french;
                        }

                })
                ->addColumn('category', function (Subscription $subscription) {
                    $category= $subscription->category()->first();
                    switch ($category->name_french){
                        case 'sociale':
                            if (app()->getLocale()=='fr')
                            {
                                return '<h5><span class="badge badge-soft-warning">'.$category->name_french.'</span></h5>';
                            }
                            else{
                                return '<h5><span class="badge badge-soft-warning">'.$category->name_arab.'</span></h5>';
                            }
                            break;
                        case 'scolaire':
                            if (app()->getLocale()=='fr')
                            {
                                return '<h5><span class="badge badge-soft-success">'.$category->name_french.'</span></h5>';
                            }
                            else{
                                return '<h5><span class="badge badge-soft-success">'.$category->name_arab.'</span></h5>';
                            }
                            break;
                        case 'civile':
                            if (app()->getLocale()=='fr')
                            {
                                return '<h5><span class="badge badge-soft-danger">'.$category->name_french.'</span></h5>';
                            }
                            else{
                                return '<h5><span class="badge badge-soft-danger">'.$category->name_arab.'</span></h5>';
                            }
                            break;
                    }
                })
                ->addColumn('mandat', function (Subscription $subscription) {
                    if($subscription->payment==null){
                        return "";
                    }
                    else{
                        if($subscription->payment->method && $subscription->payment->method->id==1){
                            return $subscription->payment->number;
                        }
                        else {
                            return "";
                        }
                    }
                })
              
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('subscriptions.show',$row->id).'" class="edit btn btn-success btn-sm">'.__('Afficher').'</a>';
                    return $btn;
                })
                ->rawColumns(['action','category'])
                ->make(true);
        }
        return view('subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=SubscriptionCategory::all();
        $centers=Center::all();
        $regions=Region::all();
        $municipalities=Municipality::all();

        $scolaire=SubscriptionCategory::where('name_french','scolaire')->first();
        $civile=SubscriptionCategory::where('name_french','civile')->first();
        $sociale=SubscriptionCategory::where('name_french','sociale')->first();

        $periodsScolaire=$scolaire->periods;
        $periodsCivile=$civile->periods;
        $periodsSociale=$sociale->periods;

            //sociétés
        $companies=Company::all();
        $phases=Phase::all();

        //paiement
        $methods=Method::all();



        //education
        $institutions=Institution::all();
        $levels=Level::all();
        $classrooms=Classroom::all();
//        $chains=Chain::where('active','0')->get();
        $lines=Line::all();
        $lines_scolaire=$scolaire->lines;
        $lines_sociale=$scolaire->lines;
        $lines_civile=$civile->lines;


        return view('subscriptions.create',
            compact('categories','lines','centers','phases','companies',
            'periodsScolaire','periodsCivile','periodsSociale','lines_scolaire','lines_civile','lines_sociale',
            'methods','regions','municipalities',
            'institutions','levels','classrooms'));
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
        if ($request->type=='scolaire'){
            $request->validate([
                'name'=>'required',
                'birth'=>'required',
//                'institution'=>'required',
                'chain'=>'required|unique:subscriptions,code'
            ]);

            if($request->client){
                $client=Client::find($request->client);
            }else{
                $client=new Client;
            }
            $client->code=$request->chain;
            $client->name =$request->name ;
            $client->parent_name =$request->parent_name ;
            $client->birth =$request->birth ;
            $client->phone=$request->phone;
            if($request->picture)
            {
                $file = $request->file('picture');
                $filedate = new DateTime('now');
                $picture = $filedate->format('YmdHis').'.'.$file->extension();
                $file->storeAs('/clients/',$picture);
                Storage::delete('/clients/'.$client->picture);
                $client->picture = $picture;
            }
            if($request->client){
                $client->update();
            }else{
                $client->save();
            }

            $address=new Address;
            $address->client_id=$client->id;
            $address->municipality_id=$request->client_municipality;
            $address->address=$request->address;
            $address->save();

            $education=new Education;
            $education->client_id=$client->id;
            $education->institution_id=$request->institution;
            $education->classroom_id=$request->classroom;
            $education->save();

            $payment=new Payment;
            $payment->method_id=$request->get("method");
            $payment->number=$request->get("payment");
            $payment->save();

            $subscription=new Subscription;
            $subscription->code=$request->chain;
            if($request->typeClient)
            {
                $subscription->type=$request->typeClient;
            }
            $subscription->client_id=$client->id;
            $subscription->period_id=$request->period;
            $subscription->phase_id=$request->phase;
            $subscription->category_id=1;
            if($request->typeClient!="etudiant"){
                $subscription->education_id=$education->id;
            }
            $subscription->payment_id = $payment->id;
            $subscription->user_id=$user->id;
            $subscription->agency_id=$user->agency_id;

            foreach ($request->lignes as $ligne)
            {
                $subscription->price += floatval($ligne['prix']);
            }


            $subscription->chain_id='1';//delete
            $phase=Phase::where('id',$request->phase)->first();

            $now = Carbon::now();
            $month = $now->format('m');
            $year=$now->year;
            if($phase->name_french!='Mensuel'){
                $subscription->start=$this->getPhaseyear($phase->start,$month,$year);
                $subscription->end=$this->getPhaseyear($phase->end,$month,$year);
            }
            else
            {
                $subscription->start="01".'-'.$month.'-'.$year;
                $subscription->end=date("t-m-Y", strtotime($subscription->start));
            }
            $subscription->year=$this->getCurrentYear($month,$year);

            $subscription->save();

            foreach ($request->lignes as $ligne)
            {
                $subscription->line()->attach($ligne['id']);
            }

            $chain=Chain::where('code',$request->chain)->first();
            $chain->used+=1;
            $chain->save();
//            if($chain->used+$chain->returned==$chain->qty){
//                $chain->active=0;
//            }
//            $chain->update();
        }
        if ($request->type=='sociale'){

            $request->validate([
                'name'=>'required',
                'birth'=>'required',
//                'institution'=>'required',
                'chain'=>'required|unique:subscriptions,code'
            ]);

            //validation nombre enfants catégorie sociale
            $countSocial=Client::where('parent_cin',$request->parent_cin)->count();
            $social=Social::where('cin',$request->parent_cin)->first();
            if($countSocial==$social->children)
            {
                return redirect()->back()->with('error','la limite Sociale a été atteint');
            }
            if($request->client){
                $client=Client::find($request->client);
            }else{
                $client=new Client;
            }

            $client->code=$request->chain;
            $client->name =$request->name ;
            $client->parent_name =$request->parent_name ;
            $client->parent_cin =$request->parent_cin ;
            $client->birth =$request->birth ;
            if($request->picture)
            {
                $file = $request->file('picture');
                $filedate = new DateTime('now');
                $picture = $filedate->format('YmdHis').'.'.$file->extension();
                $file->storeAs('/clients/',$picture);
                Storage::delete('/clients/'.$client->picture);
                $client->picture = $picture;
            }
            if($request->client){
                $client->update();
            }else{
                $client->save();
            }


            $address=new Address;
            $address->client_id=$client->id;
            $address->municipality_id=$request->client_municipality;
            $address->address=$request->address;
            $address->save();

            $education=new Education;
            $education->client_id=$client->id;
            $education->institution_id=$request->institution;
            $education->classroom_id=$request->classroom;
            $education->save();

            $subscription=new Subscription;
            $subscription->code=$request->chain;
            if($request->typeClient)
            {
                $subscription->type=$request->typeClient;
            }
            $subscription->client_id=$client->id;
            $subscription->period_id=$request->period;
            $subscription->phase_id=$request->phase;
            $subscription->category_id=3;

            if($request->typeClient!="etudiant"){
                $subscription->education_id=$education->id;

            }

            $subscription->user_id=$user->id;
            $subscription->agency_id=$user->agency_id;
            $price=0;


            $subscription->chain_id='1';//delete
            $phase=Phase::where('id',$request->phase)->first();

            $now = Carbon::now();
            $month = $now->format('m');
            $year=$now->year;
            if($phase->name_french!='Mensuel'){
                $subscription->start=$this->getPhaseyear($phase->start,$month,$year);
                $subscription->end=$this->getPhaseyear($phase->end,$month,$year);
            }
            else
            {
                $subscription->start="01".'-'.$month.'-'.$year;
                $subscription->end=date("t-m-Y", strtotime($subscription->start));
            }
            $subscription->year=$this->getCurrentYear($month,$year);

            foreach ($request->lignes as $ligne)
            {
                $subscription->price += floatval($ligne['prix']);
            }
//            $subscription->price=$price;
            $subscription->save() ;

            foreach ($request->lignes as $ligne)
            {
                $subscription->line()->attach($ligne['id']);
            }

            $chain=Chain::where('code',$request->chain)->first();
            $chain->used+=1;
            $chain->save();

        }
        if ($request->type=='civile'){
            $request->validate([
                'name'=>'required',
                'birth'=>'required',
                'chain'=>'required|unique:subscriptions,code'
            ]);

            if($request->client){
                $client=Client::find($request->client);
            }else{
                $client=new Client;
            }

            $client->code=$request->chain;
            $client->name =$request->name ;
            $client->cin =$request->cin ;
            $client->birth =$request->birth ;
            if($request->picture)
            {
                $file = $request->file('picture');
                $filedate = new DateTime('now');
                $picture = $filedate->format('YmdHis').'.'.$file->extension();
                $file->storeAs('/clients/',$picture);
                Storage::delete('/clients/'.$client->picture);
                $client->picture = $picture;
            }
            if($request->company)
            {
                $client->company_id =$request->company ;
            }
            if($request->client){
                $client->update();
            }else{
                $client->save();
            }

            $address=new Address;
            $address->client_id=$client->id;
            $address->municipality_id=$request->client_municipality;
            $address->address=$request->address;
            $address->save();

            $payment=new Payment;
            $payment->method_id=$request->get("method");
            $payment->number=$request->get("payment");
            $payment->save();

            $subscription=new Subscription;

            $subscription->code=$request->chain;
            $subscription->type="civile";
            $subscription->client_id=$client->id;
            $subscription->period_id=$request->period;
            $subscription->phase_id=$request->phase;
            $subscription->category_id=2;
            $subscription->payment_id = $payment->id;
            $subscription->user_id=$user->id;
            $subscription->agency_id=$user->agency_id;
            foreach ($request->lignes as $ligne)
            {
                $subscription->price += floatval($ligne['prix']);
            }

            $subscription->chain_id='1';//delete
            $phase=Phase::where('id',$request->phase)->first();

            $now = Carbon::now();
            $month = $now->format('m');
            $year=$now->year;
            if($phase->name_french!='Mensuel'){
                $subscription->start=$this->getPhaseyear($phase->start,$month,$year);
                $subscription->end=$this->getPhaseyear($phase->end,$month,$year);
            }
            else
            {
                $subscription->start="01".'-'.$month.'-'.$year;
                $subscription->end=date("t-m-Y", strtotime($subscription->start));
            }
            $subscription->year=$this->getCurrentYear($month,$year);
//            $subscription->price=$price;
            $subscription->save() ;

            foreach ($request->lignes as $ligne)
            {
                $subscription->line()->attach($ligne['id']);
            }

            $chain=Chain::where('code',$request->chain)->first();
            $chain->used+=1;
            $chain->save();
        }

        return redirect(route('subscriptions.show',$subscription->id));
    }
    public function generatePDF($id)
    {
        $sub=Subscription::find($id);
        $start=explode("-",$sub->start);
        $datestart=$start[2].'/'.$start[1].'/'.$start[0];
        $start=explode("-",$sub->end);
        $dateend=$start[2].'/'.$start[1].'/'.$start[0];

        $birthdate=explode("-",$sub->client->birth);
        $birth=$birthdate[2].'/'.$birthdate[1].'/'.$birthdate[0];
        $sub->start=str_replace('-','/',$sub->start);
        $sub->year=str_replace('-','/',$sub->year);

        if($sub->client->picture)
        {
            $image=url('../storage/app/clients/'.$sub->client->picture);
        }
        else{
            $image=public_path('storage/default.png');
        }
        if($sub->category->name_french=="scolaire"){

            $data=([
                'code_abn'=>$sub->code,
                'client_code'=>$sub->client->code,
                'client_name'=>$sub->client->name,
                'client_cat'=>$sub->category->name_arab,
                'client_birth'=>$birth,
//                'client_institut'=>$sub->education->institution->name_arab,
                'price'=>str_replace('.',',',$sub->price),
                'chain'=>$sub->code,
                'start'=>$datestart,
                'end'=>$dateend,
                'created'=>$sub->created_at,
                'phase'=>$sub->phase->name_arab,
                'lines' => $sub->line,
                'image'=>$image,
                'year'=>$sub->year,
                'type'=>$sub->type,
                'background'=>1
            ]);
        }elseif($sub->category->name_french=="sociale"){
            $data=([
                'code_abn'=>$sub->code,
                'client_code'=>$sub->client->code,
                'client_name'=>$sub->client->name,
                'client_cat'=>$sub->category->name_arab,
                'client_birth'=>$birth,
                'price'=>str_replace('.',',',$sub->price),
                'chain'=>$sub->code,
                'start'=>$datestart,
                'end'=>$dateend,
                'created'=>$sub->created_at,
                'phase'=>$sub->phase->name_arab,
                'lines' => $sub->line,
                'image'=>$image,
                'year'=>$sub->year,
                'type'=>$sub->type,
                'background'=>1
            ]);
        }
        else{
            if($sub->client->company) {
                $data = ([
                    'code_abn' => $sub->code,
                    'client_code' => $sub->client->code,
                    'client_name' => $sub->client->name,
                    'client_cat' => $sub->category->name_arab,
                    'client_birth' => $birth,
                    'price' => str_replace('.', ',', $sub->price),
                    'chain' => $sub->code,
                    'start' => $datestart,
                    'end' => $dateend,
                    'created' => $sub->created_at,
                    'phase' => $sub->phase->name_arab,
                    'lines' => $sub->line,
                    'image' => $image,
                    'year' => $sub->year,
                    'background' => 2,
                    'company' => $sub->client->company->name_french
                ]);
            }
            else{
                $data = ([
                    'code_abn' => $sub->code,
                    'client_code' => $sub->client->code,
                    'client_name' => $sub->client->name,
                    'client_cat' => $sub->category->name_arab,
                    'client_birth' => $birth,
                    'price' => str_replace('.', ',', $sub->price),
                    'chain' => $sub->code,
                    'start' => $datestart,
                    'end' => $dateend,
                    'created' => $sub->created_at,
                    'phase' => $sub->phase->name_arab,
                    'lines' => $sub->line,
                    'image' => $image,
                    'year' => $sub->year,
                    'background' => 2,
                    'company' => 0
                ]);
            }
            }
//        dd($sub->start);
//        foreach ($sub->line as $l){
//            dd($l->stations()->orderBy('order','desc')->first()->name_arab);
//        }

        $pdf = PDF::loadVIEW('pdf', $data)
//            ->setOption('zoom','1')
            ->setOption('page-width', '85')
            ->setOption('page-height', '54')
            ->setOption('margin-top', '0')
            ->setOption('margin-bottom', '0')
            ->setOption('margin-right', '0')
            ->setOption('margin-left', '0');

        return $pdf->download('test.pdf');
//        return view('pdf',compact('data'));
    }
    /**
     * test pdf resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function pdfshow()
    {
        return view('pdfshow');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {

        return view('subscriptions.show',compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    public function ClassByLevel($level)
    {
        $classes =Classroom::where('level_id',$level)->get();
        return response()->json($classes);
    }
    public function InsByMunLev($municipality,$level)
    {
        $intitut =Institution::where('municipality_id',$municipality)->where('level_id',$level)->get();
        return response()->json($intitut);
    }
    public function getMandat($mandat,$prix)
    {
        $res=Mandat::where('number',$mandat)->get();
        if(!$res){
            return 'introuvable';
        }
        elseif($res->active){
            return 'déja utilisé';
        }
        elseif(($res->prix)>$prix)
        {
            return 'erreur prix';
        }
        return 'accepté';

    }
    public function PhaseByPeriod($period)
    {

        $phases =Phase::where('period_id',$period)->get();
        $phases->map(function(Phase $phase) {
            $now = Carbon::now();
            $month = $now->format('m');
            $year=$now->year;
            if($phase->name_french == 'Mensuel'){

                $temporaire = "01".'-'.$month.'-'.$year;
                $phase->date_desc =$temporaire . " => " . date("t-m-Y", strtotime($temporaire));
            }
            else
            {
                $phase->date_desc =$this->getPhaseyear($phase->start,$month,$year) ." => " . $this->getPhaseyear($phase->end,$month,$year);


            }
            return $phase;
        });
        return response()->json($phases);

    }
    public function getprice($line,$cat)
    {
        $line=Line::find($line);
        if($cat=='sociale'){
            $cat='scolaire';
        }
        $category = SubscriptionCategory::where('name_french',$cat)->first();
        $price=$category->lines()->where('line_id',$line->id)->pluck('price')->first();

        $depart=$line->stations()->orderBy('order', 'asc')->first();
        $arrivée=$line->stations()->orderBy('order', 'desc')->first();
        return response()->json(['line'=>$line,'depart'=>$depart,'arrivée'=>$arrivée,'price'=>$price]);

    }
    public function verifcin(Request $request)
    {
        $cat = $request->mode;
        $remaining = false;
        switch ($cat) {
            case 'scolaire':
                $subs=Subscription::with('client.address.municipality','line.subscription','education.institution.municipality','education.institution.level.classroom'
                    ,'period','phase','payment.method')
                    ->join('clients','subscriptions.client_id','=','clients.id')
                    ->select('subscriptions.*')
                    ->where('clients.name', 'LIKE', '%'.$request->get("cin").'%')
//                    ->orWhere('clients.cin',$request->get("cin"))
                    ->get();
                $subs=$subs->map(function ($sub){
                    $sub->education=Address::where('client_id',$sub->client_id)->get();
                    return $sub;
                });
                break;
            case 'civile':
                $subs=Subscription::with('client.address.municipality','line','period','phase','payment.method')
                    ->join('clients','subscriptions.client_id','=','clients.id')
//                    ->where('clients.parent_cin', $request->get("cin"))
                    ->where('clients.cin',$request->get("cin"))
                    ->get();
                break;
            case 'sociale':
//                $subs=Subscription::with('client.address.municipality','line','period','phase')
//                    ->join('clients','subscriptions.client_id','=','clients.id')
//                    ->where('clients.parent_cin', $request->get("cin"))
//                    ->get();
//                 $numberChildren=Social::where('cin',$request->get('cin'))->pluck('children')->first();
//                $remaining =$numberChildren - $subs->count();;
                $subs=Client::where('parent_cin',$request->get('cin'))->get();
                break;
        }
        return response()->json([
            'success' => 1,
            'subscriptions' => $subs,
            'already_have' => $subs->count() > 0,
            'card' => View::make('partials.cards',['already_have'=> $subs->count() > 0,'subs' => $subs,'remaining' => $remaining,'type' =>$cat,'cin' => $request->cin])->render(),
        ]);

    }

    public function verifpayment(Request $request)
    {
        $is_valid = Payment::where('method_id',$request->method_id)->where('number',$request->payment)->exists();
        return response()->json([
            'success' => 1,
            'is_invalid' => !$is_valid,
            'message' => !$is_valid ? __('Numéro Valide') : __('Numéro Invalide'),
        ]);

    }
    public function verifref($chain)
    {
        $user=Auth::user();
        $correct = Chain::where('code',$chain)->where('agency_id',$user->agency->id)->where('used',0)->whereNull('declaration_id')->exists();
        return response()->json([
            'success' => 1,
            'correct' => $correct ? 1 : 0,
            'message' => $correct ? __('Reference Valide') : __('Reference Invalide'),
        ]);

    }
    public function verifage(Request $request)
    {
        $today = new DateTime('today');
        $sdate = $request->birth_date;
        $date = new DateTime($sdate);
        $age=Setting::first()->age_scolaire;
        if (intval($today->diff($date)->format('%Y')) < intval($age) && intval($today->diff($date)->format('%Y')) >0) {
            return response()->json(['is_valid' => 1]);
        } else {
            return response()->json(['is_valid' => false]);
        }
    }

    public function verifagecivile(Request $request)
    {
        $today = new DateTime('today');
        $sdate = $request->birth_date;
        $date = new DateTime($sdate);
        $age=Setting::first()->age_civile;
        if (intval($today->diff($date)->format('%Y')) > intval($age) && intval($today->diff($date)->format('%Y')) >0) {
            return response()->json(['is_valid' => 1]);
        } else {
            return response()->json(['is_valid' => false]);
        }
    }
    protected function getCurrentYear($month,$year)
    {
        if ($month=="09"||$month=="10"||$month=="11"||$month=="12")
        {
            if ($month=="09"||$month=="10"||$month=="11"||$month=="12")
            {
                $year=($year+1).'/'.$year;
            }else
                $year=$year.'/'.($year-1);
        }else{
            if ($month=="01"||$month=="02"||$month=="03"||$month=="04"||$month=="05"||$month=="06"||$month=="07"||$month=="08")
            {
                $year=($year-1).'-'.$year;
            }else
                $year=$year.'-'.($year+1);
        }

            return $year;

    }
    protected function getPhaseyear($phase,$month,$year)
    {
        $phasemonth=substr($phase,3,2);
        if($phasemonth=="09"||$phasemonth=="10"||$phasemonth=="11"||$phasemonth=="12") {
            if ($month=="09"||$month=="10"||$month=="11"||$month=="12")
            {
                //-2020
                $phase=$phase.'-'.$year;
            }else {
                //janvier 2021
                //2020
                $phase=$phase.'-'.($year-1);
            }

        }else{
            if ($month=="01"||$month=="02"||$month=="03"||$month=="04"||$month=="05"||$month=="06"||$month=="07"||$month=="08")
            {
                //2021
                $phase=$phase.'-'.$year;
            }else
                //2022
                $phase=$phase.'-'.($year+1);

        }
        return $phase;
    }

}
