<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $is_admin=Auth::user()->is_admin;

        if($is_admin=='1'){
            return view('adminHome');
        }
        else{
            return view('home');
        }
    }

    public function adminHome()
    {
        return view('adminHome');
    }

    public function home()
    {
        return view('home');
    }
}
