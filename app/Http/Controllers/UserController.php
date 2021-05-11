<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Subscription;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agencyId=Auth::user()->agency_id;
        if ($request->ajax()) {
            if(auth()->user()->hasRole('admin')){
                $data = User::whereNotIn('id',[Auth::id()])->latest()->get();
            }else{
                $data = User::whereNotIn('id',[Auth::id()])
                    ->where('agency_id',$agencyId)
                    ->latest()->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function (User $user) {
                    if ($user->picture)
                    {
                        $userPicture=url('../storage/app/users/'.$user->picture);
                    }
                    else{
                        $userPicture=asset('default.png');
                    }

                    $picture='<td class="table-user"> <img style="width: 30px; height: 30px; border: 1px solid #6658dd57;" src="'.$userPicture.'" alt="table-user" class="mr-2 rounded-circle"> <a href="javascript:void(0);" class="text-body font-weight-semibold">'.$user->name.'</a> </td>';
                    return $picture;
                })
                ->addColumn('agency', function (User $user) {
                        $role = $user->getRoleNames()->first();
                        if($role!="admin"){
                        $agency=$user->agency()->first();
                        return $agency->name_french;
                        }
                        else{
                            return "";
                        }
                })
                ->addColumn('role', function (User $user) {
                    $role = $user->getRoleNames()->first();
                    if($role=="user")
                    {
                        return __('utilisateur');
                    }
                    elseif($role=="supervisor"){
                        return __('superviseur');
                    }
                    else{
                        return __('admin');
                    }

                })
                ->addColumn('subscriptions', function (User $user) {
                    $subscriptions=Subscription::where('user_id',$user->id)->count();
                    return $subscriptions;
                })
                ->addColumn('action', function($row){
                    $userSub=Subscription::where('user_id',$row->id)->count();
                    $subscriptions=$userSub>0;
                    if ( $subscriptions )
                    {
                        $btn = '<a href="'.route('users.show',$row->id).'" class="edit btn btn-info btn-sm mr-1">'.__('Afficher').'</a><a href="'.route('users.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#block-alert-modal" class="block btn btn-danger btn-sm">'.__('Bloquer').'</button>';
                    }
                    else
                        {
                        $btn = '<a href="'.route('users.show',$row->id).'" class="edit btn btn-info btn-sm mr-1">'.__('Afficher').'</a><a href="'.route('users.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    }

//                    $btn = '<a href="'.route('users.edit',$row->id).'" class="edit btn btn-success btn-sm">'.__('Modifier').'</a> <button id="'.$row->id.'"  data-toggle="modal" data-target="#danger-alert-modal" class="delete btn btn-danger btn-sm">'.__('Supprimer').'</button>';
                    return $btn;
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('admin')){
            $roles= Role::all();
            $roles=$roles->sortByDesc('name');
            $agencies=Agency::all();
        }
        else
            {
                $roles= Role::where('name','user')->get();
//                $roles=$roles->sortByDesc('name');
                $agencies=Auth::user()->agency_id;
        }
        return view('users.create',compact('roles','agencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate ([
            'name' => 'required|min:3|max:50',
            'email' => 'email|unique:users',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
        ]);

        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        if(auth()->user()->hasRole('supervisor')){
            $user->agency_id=auth()->user()->agency->id;
        }else
            $user->agency_id=$request->agency;
        $user->save();
        $user->assignRole($request->role);

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        $role=$user->getRoleNames()->first();
        $subscriptions=Subscription::all()->count();
        $login=$user->last_login_at;
//        $currentDate = new \DateTime('monday this week');
//        $endDate = new \DateTime('sunday this week');
//
//        $sub_scolaire = Subscription::where('category_id',1)->where('user_id',$user->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at;
//            });
//        $sub_civile = Subscription::where('category_id',2)->where('user_id',$user->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at;
//            });
//        $sub_sociale = Subscription::where('category_id',3)->where('user_id',$user->id)->where('created_at','>',$currentDate)
//            ->where('created_at','<',$endDate)
//            ->get()
//            ->groupBy(function ($e) {
//                return $e->created_at;
//            });
//
//        while ($currentDate <= $endDate) {
//            $initscolaire[$currentDate] = 0;
//            $initcivile[$currentDate] = 0;
//            $initsociale[$currentDate] = 0;
//            $currentDate->modify('+1 day');
//        }
//
//        foreach ($sub_scolaire as $key => $value) {
//            if (isset($initscolaire[$key])) {;
//                $initscolaire[$key]=$value->count();
//            }
//        }foreach ($sub_civile as $key => $value) {
//        if (isset($initscolaire[$key])) {;
//            $initscolaire[$key]=$value->count();
//        }
//    }foreach ($sub_sociale as $key => $value) {
//        if (isset($initscolaire[$key])) {;
//            $initscolaire[$key]=$value->count();
//        }
//    }
        return view('users.show',compact('user','role','subscriptions','login'));
    }


    public function edit(User $user)
    {
        if(auth()->user()->hasRole('admin')){
            $roles= Role::all();
            $roles=$roles->sortByDesc('name');
            $agencies=Agency::all();
        }
        else
        {
            $roles= Role::where('name','user')->get();
//                $roles=$roles->sortByDesc('name');
            $agencies=auth()->user()->agency->id;
        }
        $userRole=$user->getRoleNames()->first();
//        dd(Auth::id()==$user->id && $userRole=="supervisor");
        return view('users.edit',compact('user','roles','agencies','userRole'));
    }


    public function update(User $user,Request $request)
    {
        request()->validate ([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->agency_id=$request->agency;
        $user->update();
        $userRole=auth()->user()->getRoleNames()->first();

        if(Auth::id()==$user->id && $userRole=="admin")
            $user->assignRole("admin");
        elseif(Auth::id()==$user->id && $userRole=="supervisor")
            $user->assignRole("supervisor");
        else
            $user->assignRole($request->get('role'));

        return redirect(route('users.index'));
    }
    public function updatePassword(User $user,Request $request)
    {
        request()->validate ([
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
        ]);

        $user->password=$request->get('password');
        $user->update();

        return redirect(route('users.index'));
    }

    public function updatePicture(User $user,Request $request)
    {
        $file = $request->file('picture');
        $filedate = new DateTime('now');
        $picture = $filedate->format('YmdHis').'.'.$file->extension();
        $file->storeAs('/users/',$picture);
        Storage::delete('/users/'.$user->picture);
        $user->picture = $picture;
        $user->update();

        return redirect(route('users.index'));
    }
    /**
     * SoftDelete a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function block(User $user)
    {
        $user->delete();
    }

    /**
     * Display a listing of the SoftDeleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blocked(Request $request)
    {
        $agencyId=Auth::user()->agency_id;
        if ($request->ajax()) {
            if(auth()->user()->hasRole('admin')){
                $data = User::whereNotIn('id',[Auth::id()])->latest()->onlyTrashed()->get();
            }else{
                $data = User::whereNotIn('id',[Auth::id()])
                    ->where('agency_id',$agencyId)
                    ->latest()->onlyTrashed()->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('agency', function (User $user) {
                    $agency=$user->agency()->withTrashed()->first();
                    return $agency->name_french;
                })
                ->addColumn('role', function (User $user) {
                    $role = $user->getRoleNames()->first();
                    if($role=="user")
                    {
                        return __('utilisateur');
                    }
                    elseif($role=="supervisor"){
                        return __('superviseur');
                    }
                    else{
                        return __('admin');
                    }

                })
//                ->addColumn('subscriptions', function (User $user) {
//                    $subscriptions=$user->subscriptions()->count();
//                    return $subscriptions;
//                })
                ->addColumn('action', function($row){
                        $btn = '<button id="'.$row->id.'"  data-toggle="modal" data-target="#restore-alert-modal" class="restore btn btn-success btn-sm">'.__('Restaurer').'</button>';
                 return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.blocked');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        User::withTrashed()->find($id)->restore();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
    }
}
