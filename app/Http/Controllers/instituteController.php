<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Event;
use App\news;
use App\EventIntrest;
use App\eventTarget;
use App\Institute;
use Image;

class instituteController extends Controller
{
	public function __construct()
    {
    	$this->middleware(['auth','institute']);
        $this->middleware(function ($request, $next) {
            $this->date = date('Y-m-d');
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function index()
    {
        $news= institute::has('news')->paginate(10);
         return view('institute.viewAllNews',["news"=>$news]);

        # code...
    }


 public function edit($newsID)

    {
        $news = news::find($newsID);
        return view('institute.editMyNews',["news"=>$news]);
    }

}
