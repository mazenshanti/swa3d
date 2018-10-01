<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Friend;
use App\User;
use App\Volunteer;
use App\researches;
use App\Initiative;
use App\news;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

function boot()
{
    Schema::defaultStringLength(191);

    Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
      $min_field = $parameters[0];
      $data = $validator->getData();
      return $value > $min_field;
    });   

    Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
        $message = "must be greater than zero";
      return str_replace(':field', $parameters[0], $message);
    });

    view()->composer('individual/includes.sidebar',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $userIndividual = $user->Individuals;
        $data = array(
            'user' => Auth::user(),
            'myInitiatives' => initiative::where('adminId',$user->id),
            'followers' => friend::where('requested_id', $user->id),
            'following' => friend::where('requester_id', $user->id),
            'researches' => researches::where('ind_id',$userIndividual->id),
            'myUpComingEvents' => volunteer::join('events','volunteers.event_id','=','events.id')->where('volunteers.user_id',$user->id)->where('events.endDate','>=',$date),
            'myArchiveEvents' => volunteer::join('events','volunteers.event_id','=','events.id')->where('volunteers.user_id',$user->id)->where('events.endDate','<',$date),
        );

        $view->with($data);
    });

    view()->composer('institute/includes.sidebar',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $data = array(
            'user' => Auth::user(),
            'followers' => friend::where('requested_id', $user->id),
            'following' => friend::where('requester_id', $user->id),
        );
        $view->with($data);
    });

    view()->composer('initiative/includes.sidebar',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $data = array(
            'user' => Auth::user(),
            'followers' => friend::where('requested_id', $user->id),
            'following' => friend::where('requester_id', $user->id),
        );
        $view->with($data);
    });

    
    view()->composer('includes/events',function($view){
        $date = date('Y-m-d');
        $user = Auth::user();
        $eventsVolunteeredAt = null;
        if(Auth::check()) $eventsVolunteeredAt = Volunteer::where('user_id',$user->id)->get();
        $data = array(
            'eventsVolunteeredAt' => $eventsVolunteeredAt,
        );
        $view->with($data);
    });

    view()->composer('admin/includes/adminSidebar',function($view){
        $user = Auth::user();
        if($user->userType == 10) 
        {
            $news_count = news::where([['approved','0'],['publish','1']])->count();
            $data = array(
                'news_count' => $news_count,
            );
            $view->with($data);
        }
    });

}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {



}
}
