<?php

namespace App\Http\Controllers;

use App;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $data['title'] = "Dashboard";

            $data['base_url'] = App::make("url")->to('/');
            $data['prof_pic'] = UserProfile::where('user_id', '=', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

            return view('admin.dashboard', $data);

    }
}
