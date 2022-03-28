<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $prefix;
    public $title;
    public $segment;

    public function __construct()
    {
      $this->title =  "Dashboard";
      $this->segment = \Request::segment(2);
    }
    public function index()
    {
        $this->prefix = request()->route()->getPrefix();

        return view('dashboard',['prefix'=>$this->prefix,'title'=>$this->title,'segment'=>$this->segment]);
    }

    public function ForbiddenPage(Request $request)
    {
        return view('forbidden');
    }
}
