<?php

namespace App\Http\Controllers;
use App\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\User;
use App\Individuals;
use App\Institute;
use App\Event;

class searchController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->date = date('Y-m-d');
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function slidbare()
    {
        $date = $this->date;
        $user = $this->user;
        return [$user ,$date];
    }

    public function basic(Request $request)
    {
        $users = DB::table('individuals')
        ->where('nameInEnglish', 'like','%'.$request['name'].'%')
        ->orwhere('nameInArabic', 'like','%'.$request['name'].'%')
        ->take(5)->get();
        $institutes = DB::table('institutes')
        ->where('nameInEnglish', 'like','%'.$request['name'].'%')
        ->orwhere('nameInArabic', 'like','%'.$request['name'].'%')
        ->take(5)->get();

        return view('results',['users'=>$users,'institutes'=>$institutes ]);
    	# code...
    }

    public function basicSearch(Request $request)
    {  

        if(request()->has('location')){
             // intrest in location

             if(request()->has('intrest')){

                 $users= DB::table("individuals")
                 ->join('user_intrests', function ($join) {
                 $join->on('individuals.user_id', '=', 'user_intrests.user_id')
                 ->whereIn('user_intrests.intrest_id', request('intrest'))
                 ;})
                 ->where('individuals.country','=',request('location'))
                 ->get();
                 
                 $NGOs= DB::table("institutes")
                 ->join('user_intrests', function ($join) {
                 $join->on('institutes.user_id', '=', 'user_intrests.user_id')
                 ->whereIn('user_intrests.intrest_id', request('intrest'))
                 ->where('institutes.country','=',request('location'));})
                 ->get();
                 // location &intrest & target

                 if(request()->has('target')){
                     $users = DB::table('individuals')
                     ->join('user_intrests', 'individuals.user_id', '=', 'user_intrests.user_id')
                     ->join('user_targets', 'individuals.user_id', '=', 'user_targets.user_id')
                     ->whereIn('user_targets.target_id',request('target'))
                     ->whereIn('user_intrests.intrest_id', request('intrest'))
                     ->where('individuals.country','=',request('location'))
                     ->get();
                      $NGOs = DB::table('institutes')
                     ->join('user_intrests', 'institutes.user_id', '=', 'user_intrests.user_id')
                     ->join('user_targets', 'institutes.user_id', '=', 'user_targets.user_id')
                     ->whereIn('user_targets.target_id',request('target'))
                     ->whereIn('user_intrests.intrest_id', request('intrest'))
                       ->where('institutes.country','=',request('location'))
                     ->get();
                  }

             }
             // location & target** id is userID in  individual (prevously was user.id)  changed to match the location and name ...and target id is target_id 

             elseif(request()->has('target')){
                 $users= DB::table("individuals")->join('user_targets', function ($join) {
                 $join->on('individuals.user_id', '=', 'user_targets.user_id')
                 ->whereIn('user_targets.target_id',request('target'))
                 ->where('individuals.country','=',request('location'));})
                 ->get();
                   $NGOs= DB::table("institutes")->join('user_targets', function ($join) {
                 $join->on('institutes.user_id', '=', 'user_targets.user_id')
                 ->whereIn('user_targets.target_id',request('target'))
                 ->where('institutes.country','=',request('location'));})
                 ->get();
             }

                // location only filter
             else{
                 $users = Individuals::where('country','=',$request['location'])
                 ->get();
                 $NGOs=institute::where('country','=',$request['location'])
                 ->get();
                 }
            }

         elseif(request()->has('intrest')){

             // intrest & target
             if(request()->has('target')){

                 $users = DB::table('individuals')
                 ->join('user_intrests', 'individuals.user_id', '=', 'user_intrests.user_id')
                 ->join('user_targets', 'individuals.user_id', '=', 'user_targets.user_id')
                 ->whereIn('user_targets.target_id',request('target'))
                 ->whereIn('user_intrests.intrest_id', request('intrest'))
                 ->get();

                  $NGOs = DB::table('institutes')
                 ->join('user_intrests', 'institutes.user_id', '=', 'user_intrests.user_id')
                 ->join('user_targets', 'institutes.user_id', '=', 'user_targets.user_id')
                 ->whereIn('user_targets.target_id',request('target'))
                 ->whereIn('user_intrests.intrest_id', request('intrest'))
                 ->get();
             }
                // intrest only
             else {

                     $users= DB::table("individuals")
                     ->join('user_intrests', function ($join) {
                     $join->on('individuals.user_id', '=', 'user_intrests.user_id')
                     ->whereIn('user_intrests.intrest_id', request('intrest'));})

                     ->get();
                      $NGOs= DB::table("institutes")
                     ->join('user_intrests', function ($join) {
                     $join->on('institutes.user_id', '=', 'user_intrests.user_id')
                     ->whereIn('user_intrests.intrest_id', request('intrest'));})
                     ->get();
                }
          }
        
         // target only filter
          elseif(request()->has('target')){
             $users= DB::table("individuals")
             ->join('user_targets', function ($join) {
             $join->on('individuals.user_id', '=', 'user_targets.user_id')
             ->whereIn('user_targets.target_id',request('target'));})
             ->get();
             $NGOs= DB::table("institutes")
             ->join('user_targets', function ($join) {
             $join->on('institutes.user_id', '=', 'user_targets.user_id')
             ->whereIn('user_targets.target_id',request('target'));})
            ->get();
         }
            $userss= array();
            $var=0;
            foreach ($users as $u) {
                if ($u->user_id!=$var) {
                    $var=$u->user_id;
                    array_push($userss, $u);
                    # code...
                }
            }
            $users=$userss;
            // -------------
            $NGOss= array();
            $var=0;
            foreach ($NGOs as $u) {
                if ($u->user_id!=$var) {
                    $var=$u->user_id;
                    array_push($NGOss, $u);
                    # code...
                }
            }
            $institutes=$NGOss;

            return view('results',compact('users','institutes'));

     }


    public function volunteersSearch(Request $request)

    {  

        list($user ,$date)=$this->slidbare();
        $following = friend::where('requester_id', $user->id)->get();

         if(request()->has('location')){
             // intrest in location

             if(request()->has('intrest')){

                 $users= DB::table("individuals")
                 ->join('user_intrests', function ($join) {
                 $join->on('individuals.user_id', '=', 'user_intrests.user_id')
                 ->whereIn('user_intrests.intrest_id', request('intrest'))
                 ;})
                 ->where('individuals.country','=',request('location'))
                 ->get();
                 
                 // location &intrest & target

                 if(request()->has('target')){
                     $users = DB::table('individuals')
                     ->join('user_intrests', 'individuals.user_id', '=', 'user_intrests.user_id')
                     ->join('user_targets', 'individuals.user_id', '=', 'user_targets.user_id')
                     ->whereIn('user_targets.target_id',request('target'))
                     ->whereIn('user_intrests.intrest_id', request('intrest'))
                     ->where('individuals.country','=',request('location'))
                     ->get();
                    
                  }

             }
             // location & target** id is userID in  individual (prevously was user.id)  changed to match the location and name ...and target id is target_id 

             elseif(request()->has('target')){
                 $users= DB::table("individuals")->join('user_targets', function ($join) {
                 $join->on('individuals.user_id', '=', 'user_targets.user_id')
                 ->whereIn('user_targets.target_id',request('target'))
                 ->where('individuals.country','=',request('location'));})
                 ->get();
                 
             }

                // location only filter
             else{
                 $users = Individuals::where('country','=',$request['location'])
             ->get();
                 }
            }

         // intrest filter
         elseif(request()->has('intrest')){

             // intrest & target
             if(request()->has('target')){

                 $users = DB::table('individuals')
                 ->join('user_intrests', 'individuals.user_id', '=', 'user_intrests.user_id')
                 ->join('user_targets', 'individuals.user_id', '=', 'user_targets.user_id')
                 ->whereIn('user_targets.target_id',request('target'))
                 ->whereIn('user_intrests.intrest_id', request('intrest'))
                 ->get();

             }
                // intrest only
             else {

                     $users= DB::table("individuals")
                     ->join('user_intrests', function ($join) {
                     $join->on('individuals.user_id', '=', 'user_intrests.user_id')
                     ->whereIn('user_intrests.intrest_id', request('intrest'));})
                     ->get();
              
                }
          }
        
         // target only filter
          elseif(request()->has('target')){
             $users= DB::table("individuals")
             ->join('user_targets', function ($join) {
             $join->on('individuals.user_id', '=', 'user_targets.user_id')
             ->whereIn('user_targets.target_id',request('target'))
             ;})
             ->get();
            
         }
            // $userss= array();
            // $var=0;
            // foreach ($users as $u) {
            //     if ($u->user_id!=$var) {
            //         $var=$u->user_id;
            //         array_push($userss, $u);
            //         # code...
            //     }
            // }
            $users_record=$users; 
          // lazy to change all the variables  names :3 :P 
            $userUevents = Event::where('events.user_id',$user->id)->where('startDate','>',$date)->get();
            return view('shared.findVolunteers',compact('users_record','following','userUevents'));

     

         # code...
    } 

}


