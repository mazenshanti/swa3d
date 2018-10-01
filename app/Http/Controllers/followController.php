<?php

namespace App\Http\Controllers;
use App\Friend;
use Illuminate\Support\Facades\auth;
use Illuminate\Http\Request;

class followController extends Controller
{
	public function __construct()
    {
    	$this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $date = date('Y-m-d');
            $user = Auth::user();
            $this->date = $date;
            $this->user = $user;
            return $next($request);
        });
    }

    public function followers()
    {
        $user = $this->user;
        $followers = friend::join('users','friends.requester_id','=','users.id')->where('requested_id', $user->id)->get();
        $following = friend::where('requester_id', $user->id)->get();
        	return view('shared/followers',compact('followers','following'));
    }

    public function following()
    {
        $user = $this->user;
        $following = Friend::join('users','friends.requested_id','=','users.id')->where('requester_id', $user->id)->get();
        	return view('shared/following',compact('following'));
    }
    
    public function follow($userId)
    {
        $user = $this->user;
        $friend = Friend::where('requester_id', '=', $user->id)
                      ->where('requested_id', '=', $userId)->first();
        if(!$friend)
        {
            $friend = new Friend();
            $friend->requester_id = $user->id;
            $friend->requested_id = $userId;
            $friend->save();
            return redirect()->back();
        }
        return redirect()->route('errorPage')->withErrors('already followed.');
    }

    public function unfollow($userId)
    {
        $user = $this->user;
        $friend = Friend::where('requester_id', '=', $user->id)
                      ->where('requested_id', '=', $userId)->delete();
        return redirect()->back();
    }
}
